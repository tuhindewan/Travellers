<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Host;
use App\Models\HostAccumulator;
use App\Models\HostAccumulatorImage;
use App\Models\AccumulatorRooms;
use App\Models\AccumulatorRoomImage;
use App\Models\BookingAccumulator;
use App\Models\UserRoomBooking;
use Auth;
use Session;
class HostsController extends Controller
{
    public function index()
    {
    	$hostPlaces = HostAccumulator::where('status',1)->raw(function($collection) {
            return $collection->aggregate([
                [
                    '$group' => [
                    '_id' => array(
                    'location' => '$location'
                    ),
                    'count' => ['$sum' => 1],
                    ]
                ],
            ]);
        });
        $maxprice = AccumulatorRooms::max('rent_rate');
        //return $hostPlaces;
        //$hostPlaces = Host::where('status',1)->groupBy('city')->get();
        //return $hostPlaces[0]->city;
        return view('frontend/hosts/local', compact('hostPlaces','maxprice'));
    }


    public function cityWise($location)
    {
        //check location 
        $hosts = HostAccumulator::where('status',1)->where('location',$location)->get();
        $roomCheck = array();

        if(Session::has('searchDetail')){
            $search = Session::get('searchDetail');
            $checkIn = $search['check_in'];
            $checkOut = $search['check_out'];
            
        }else{
            $checkIn = '';
            $checkOut = '';
        }
        
        if($checkIn !== '' && $checkOut !== ''){
            foreach ($hosts as $host_details) {
            
        
                foreach ($host_details->accumulator_room as $room) {
                    

                    $checkInData = BookingAccumulator::checkInRoomAvailable($host_details->_id, $room->_id, $checkIn, $checkOut);

                    $checkOutData = BookingAccumulator::checkOutRoomAvailable($host_details->_id, $room->_id, $checkIn, $checkOut);
                    //$roomCheck[] = $checkOutData;
                    if(count($checkInData) > 0){
                        $roomCheck[] = [
                            'accumulatorId' => $host_details->_id,
                            'roomId' =>$room->_id,
                            'status' => 1
                        ];
                    }

                    if(count($checkOutData) > 0){
                        $roomCheck[] = [
                            'accumulatorId' => $host_details->_id,
                            'roomId' =>$room->_id,
                            'status' => 1
                        ];
                    }
                    
                }    
            }
        }

        $maxprice = AccumulatorRooms::max('rent_rate');
        return view('frontend/hosts/index',compact('hosts','maxprice','roomCheck'));
    }

    public function placeDetails($location, $place)
    {
        $host_details = HostAccumulator::where('status',1)->where('location',$location)->where('title',$place)->first();
        $roomCheck = array();
        if(Session::has('searchDetail')){
            $search = Session::get('searchDetail');
            $checkIn = $search['check_in'];
            $checkOut = $search['check_out'];
            
        }else{
            $checkIn = '';
            $checkOut = '';
        }
        
        if($checkIn !== '' && $checkOut !== ''){
            foreach ($host_details->accumulator_room as $room) {
                

                $checkInData = BookingAccumulator::checkInRoomAvailable($host_details->_id, $room->_id, $checkIn, $checkOut);

                $checkOutData = BookingAccumulator::checkOutRoomAvailable($host_details->_id, $room->_id, $checkIn, $checkOut);
                
                if(count($checkInData) > 0){
                    $roomCheck[] = [
                        'id' =>$room->_id,
                        'status' => 1
                    ];
                }

                if(count($checkOutData) > 0){
                    $roomCheck[] = [
                        'id' =>$room->_id,
                        'status' => 1
                    ];
                }
                
            }    
        }
        
        $roomImages = AccumulatorRoomImage::get();
        $maxprice = AccumulatorRooms::max('rent_rate');
        
        return view('frontend.hosts.details',compact('host_details','roomImages','maxprice','roomCheck'));
        
    }

    public function booking($id)
    {
        $host_details = Host::where('status',1)->where('_id',new \MongoDB\BSON\ObjectID($id))->first();
        
        if(count($host_details) > 0){
            $checkExist = BookingAccumulator::checkExistRequest($id);
            if(count($checkExist) > 0){

                return redirect()->back()->with('error','You are already reserved');
            }
            $input['fk_user_id'] = Auth::user()->_id;
            $input['host_id'] = $id;
            $input['is_unread'] = 0;
            $input['status'] = 0;
            BookingAccumulator::create($input);
            return redirect()->back()->with('success','Successfully');
        }
        return redirect()->back()->with('error','something went wrong please try again');
        
    }

    public function bookingRoom(Request $request)
    {
        $input = $request->all();
        $countRoom = count($input['room_id']);
        $authId = Auth::user()->_id;
        try {
            if($countRoom > 0){
                $urlData = '';
                for ($r=0; $r < $countRoom; $r++) { 
                    $data = [
                        'fk_user_id'        => $authId,
                        'fk_accumulator_id' => $input['accumulator_id'],
                        'fk_room_id'        => $input['room_id'][$r],
                        'check_in'          => $input['check_in'],
                        'check_out'         => $input['check_out'],
                        're_confirm'        => 1,
                        'status'            => 0,
                        'is_unread'         => 0
                    ];  
                    $bookingId = BookingAccumulator::create($data)->_id;

                    //check user exists in user booking room status
                    $checkUserExist = UserRoomBooking::checkUserExistsin($authId);
                    $getUserBooking = UserRoomBooking::findOrFail($checkUserExist['_id']);
                    if(count($checkUserExist) > 0){
                        //update booking info
                        $requestRoom = $checkUserExist['user_request'] + 1;
                        $user_request = [
                            'user_request' => $requestRoom
                        ];
                        $getUserBooking->update($user_request);
                    }else{
                        //create user form user room booking table/collection
                        UserRoomBooking::requestRoomBooking($authId);
                    }

                    if($urlData==''){
                        $urlData = $bookingId;
                    }else{
                        $urlData = $urlData.'_'.$bookingId;
                    }
                }
            }
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];   
        }
        if($bug == 0){
            
            return redirect('booking-confirmation/'.$urlData)->with('success','Booking Successfully.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }
    }
    public function bookingConfirm($id)
    {
        $bookingId = explode('_',$id);
        $getBooking = array();
        $countBooking = count($bookingId);
        for ($i=0; $i < $countBooking; $i++) { 
            $data = BookingAccumulator::findOrFail($bookingId[$i]);
            $getBooking[] =$data;
        }
        $maxprice = AccumulatorRooms::max('rent_rate');
        //return $getBooking[0]->accumulator_room;
        return view('frontend/hosts/booking_confirm', compact('getBooking','maxprice','id'));
    }
    public function accuSearch(Request $request)
    {
        $input = $request->all();
        if($input['location'] == ''){

            $hosts = HostAccumulator::searchLocationEmptyWiseAccumulator($input);
        }else{
            $hosts = HostAccumulator::searchLocationWiseAccumulator($input);
        }

        $roomCheck = array();

        $checkIn = $input['check_in'];
        $checkOut = $input['check_out'];
        
        
        
        foreach ($hosts as $host_details) {
            
        
            foreach ($host_details->accumulator_room as $room) {
                

                $checkInData = BookingAccumulator::checkInRoomAvailable($host_details->_id, $room->_id, $checkIn, $checkOut);

                $checkOutData = BookingAccumulator::checkOutRoomAvailable($host_details->_id, $room->_id, $checkIn, $checkOut);
                //$roomCheck[] = $checkOutData;
                if(count($checkInData) > 0){
                    $roomCheck[] = [
                        'accumulatorId' => $host_details->_id,
                        'roomId' =>$room->_id,
                        'status' => 1
                    ];
                }

                if(count($checkOutData) > 0){
                    $roomCheck[] = [
                        'accumulatorId' => $host_details->_id,
                        'roomId' =>$room->_id,
                        'status' => 1
                    ];
                }
                
            }    
        }
        
        //return $roomCheck;

        \Session::put('searchDetail',$input);
        //return $hosts;
        $maxprice = AccumulatorRooms::max('rent_rate');
        return view('frontend/hosts/index',compact('hosts','maxprice','roomCheck'));
    }

    public function myReservation()
    {   
        $authId = Auth::user()->_id;
        $getBooking = BookingAccumulator::where('fk_user_id',$authId)->orderBy('_id','desc')->get();
        $maxprice = AccumulatorRooms::max('rent_rate');
        $roomImages = AccumulatorRoomImage::get();
        //return $getBooking[0]->host_accumulator;
        return view('frontend/hosts/reservations', compact('maxprice','getBooking','roomImages'));
    }

    public function bookingCancel(Request $request)
    {
        $input = $request->all();
        $getBooking = BookingAccumulator::findOrFail($input['id']);
        $getBooking->delete();
        //check user exists in user booking room status
        $authId = Auth::user()->_id;
        $checkUserExist = UserRoomBooking::checkUserExistsin($authId);
        $getUserBooking = UserRoomBooking::findOrFail($checkUserExist['_id']);
        //update booking info
        $requestRoom = $checkUserExist['user_cancel'] + 1;
        $user_cancel = [
            'user_cancel' => $requestRoom
        ];
        $getUserBooking->update($user_cancel);
        
        //end
        return redirect()->back()->with('success','Booking cancel successfully.');
    }
}
