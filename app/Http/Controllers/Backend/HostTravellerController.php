<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Models\Host;
// use App\Models\HostImage;
use App\Models\HostDestination;
use App\Models\BookingAccumulator;
use App\Models\HostAccumulator;
use App\Models\HostAccumulatorImage;
use App\Models\AccumulatorRooms;
use App\Models\AccumulatorRoomImage;
use App\Models\UserRoomBooking;
use App\Models\BookingNotification;
use Auth;
use Validator;
use DB;
use Image;
use App\User;
class HostTravellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authId = Auth::user()->_id;
        $getAccumulator = HostAccumulator::where('fk_host_id',$authId)->orderBy('created_at','desc')->get();
        return view('backend.host-traveller.view_plan', compact('getAccumulator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.host-traveller.create_plan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*validator all field*/
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
            'location' => 'required'
            
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        
        if(isset($input['status']) && $input['status']=='on'){
            
            $input['status'] = 1;
        }else{
            $input['status'] = 0;
        }
        
        $input['fk_host_id'] = Auth::user()->_id;
        try {
            //accumulator create
            $accumulatorId = HostAccumulator::create($input)->_id;
            $accuImageCount = count($input['accumulator_image']);
            if($accuImageCount > 0){
                for ($a=0; $a < $accuImageCount; $a++) { 
                    HostAccumulatorImage::createAccumulatorImage($accumulatorId, $input['accumulator_image'][$a]);   
                }
            }
            //booking room section
            $roomBookingCount = count($input['room_type']);
            if($roomBookingCount > 0){
                $r = 1;
                for ($b=0; $b < $roomBookingCount; $b++) {
                    $roomData = [
                        'room_type' => $input['room_type'][$b],
                        'room_description' => $input['room_description'][$b],
                        'adult' => $input['adult'][$b],
                        'children' => $input['children'][$b],
                        'rent_rate' => $input['rent_rate'][$b],
                        'currency' => $input['currency'][$b]
                    ];
                    $bookId = AccumulatorRooms::createRoom($accumulatorId, $roomData);
                    //room image create
                    $roomImage = $input["room_$r"];
                    if($roomImage > 0){
                        for ($i=0; $i < count($roomImage); $i++) { 
                            AccumulatorRoomImage::createAccumulatorRoomImage($bookId, $roomImage[$i]);  
                        }
                    }
                    $r++;
                }
            }
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        if($bug == 0){
            return redirect()->back()->with('success','Accumulator Upload Successfully.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $accumulator = HostAccumulator::findOrFail($id);
        $room = $accumulator->accumulator_room;
        $roomImages = AccumulatorRoomImage::get();
        //return $roomImages;
        return view('backend.host-traveller.show_plan', compact('accumulator','roomImages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $getPlan = HostAccumulator::findOrFail($id);

        //check image 
        $countImage = count($getPlan->host_info_image);
        for ($i=0; $i < $countImage ; $i++) { 
            $getPlanImg = HostImage::findOrFail($getPlan->host_info_image[$i]['_id']);
            $getPlanImg->delete();
            $imgPath = $getPlan->host_info_image[$i]['images'];
            $thum_path = 'images/host/photo/thum/'.$imgPath;
            $img_path = 'images/host/photo/'.$imgPath;
            if(file_exists($thum_path)){
                unlink($thum_path);
            }
            if(file_exists($img_path)){
                unlink($img_path);
            }
        }

        $getPlan->delete();
        return redirect()->back()->with('success','Delete Successfully');
    }

    public function reserve()
    {
        $authId = Auth::user()->_id;

        $getBooking = BookingAccumulator::orderBy('_id','desc')->get();

        $bookingData = array();
        foreach ($getBooking as $booking) {
            if($booking->host_accumulator->fk_host_id == $authId){
                $bookingData[] = $booking;
            }       
        }
        
        return view('backend.host-traveller.reserve_accumulator', compact('bookingData')); 
    }

    public function loadDetails($value)
    {
        return view('backend.host-traveller.load_room_details', compact('value'));
    }

    public function imageUpload(Request $request,$value)
    {
        $input = $request->all();
        $imageData = $input['image'];
        if($value==0){
           $main = 'images/host/photo/';
           $thum =  'images/host/photo/thum/';    
        }else{
           $main = 'images/host/room/photo/';
           $thum =  'images/host/room/photo/thum/'; 
        }
        if (preg_match('/data:image\/(gif|jpeg|png);base64,(.*)/i', $imageData, $matches)) {
            $imageType = $matches[1];
            $imageData = base64_decode($matches[2]);

            $image = imagecreatefromstring($imageData);
            $filename = md5($imageData) . '.png';

            
            $img = Image::make($imageData);
                    
            $imageName = rand(1,1000).date('dmyhis').".png";
            /*auto*480 size image */
            $directory = $main.date("Y").'/'.date("m").'/'.date("d").'/';

            //If the directory doesn't already exists.
            if(!is_dir($directory)){
                //Create our directory.
                mkdir($directory, 755, true);
            }
            $img->resize(null, 480, function ($constraint) {
                $constraint->aspectRatio();
                //$constraint->upsize();
            });
            $save_path = date("Y").'/'.date("m").'/'.date("d").'/'.$imageName;
            $img->save($main.$save_path);

            /*thum size image */
            $directoryThum = $thum.date("Y").'/'.date("m").'/'.date("d").'/';

            //If the directory doesn't already exists.
            if(!is_dir($directoryThum)){
                //Create our directory.
                mkdir($directoryThum, 755, true);
            }
            $img->resize(null, 243, function ($constraint) {
                $constraint->aspectRatio();
                //$constraint->upsize();
            });
            $save_path = date("Y").'/'.date("m").'/'.date("d").'/'.$imageName;
            $img->save($thum.$save_path);
          
          }
          
          return $save_path;
        
        
    }

    public function imageRemove(Request $request,$value)
    {
        $input = $request->all();
        // if($value==0){
                
        // }else{
        //     echo $value;
        // }
        $path = $input['path'];
        $thum_path = $path.'thum/'.$input['image'];
        $img_path = $path.$input['image'];
        if(file_exists($thum_path)){
            unlink($thum_path);
        }
        if(file_exists($img_path)){
            unlink($img_path);
        }
        return "success";  
    }

    public function reserveRequestConfirm($id)
    {
        $getBooking = BookingAccumulator::findOrFail($id);
        
        $currentData = date('Y-m-d');
         

        if($getBooking->check_in >=$currentData){
            $status = [
                'status' => 1
            ];
            $getBooking->update($status);
            //check user exists in user booking room status
            $userId = $getBooking->fk_user_id;
            $checkUserExist = UserRoomBooking::checkUserExistsin($userId);
            $getUserBooking = UserRoomBooking::findOrFail($checkUserExist['_id']);
            //update booking info
            $requestRoom = $checkUserExist['host_confirm'] + 1;
            $host_confirm = [
                'host_confirm' => $requestRoom
            ];
            $getUserBooking->update($host_confirm);
            
            //end
            //booking create notification
            $input = [
                'fk_user_id' => $userId,
                'thread_id' => $getBooking->_id,
                'thread_type' => 'booking',
                'body_text' => 'Your '.$getBooking->host_accumulator->place_name.' booking is confirmed',
                'is_unread' => 0,
            ];
            BookingNotification::create($input);
            return redirect()->back()->with('success', $getBooking->users['fullname'].' booking confirm');
        }else{
            return redirect()->back()->with('error', 'Booking time out');
        }
    }

    public function reserveRequestReject($id)
    {
        $getBooking = BookingAccumulator::findOrFail($id);
        //check user exists in user booking room status
        $userId = $getBooking->fk_user_id;
        $checkUserExist = UserRoomBooking::checkUserExistsin($userId);
        $getUserBooking = UserRoomBooking::findOrFail($checkUserExist['_id']);
        //update booking info
        $requestRoom = $checkUserExist['host_reject'] + 1;
        $host_reject = [
            'host_reject' => $requestRoom
        ];
        $getUserBooking->update($host_reject);
        //end
        $status = [
            'status' => 2
        ];
        $getBooking->update($status);
        //booking create notification
            $notification = [
                'fk_user_id' => $userId,
                'thread_id' => $getBooking->_id,
                'thread_type' => 'booking',
                'body_text' => 'Your '.$getBooking->host_accumulator->place_name.' booking is rejected',
                'is_unread' => 0
            ];
            BookingNotification::create($notification);
        return redirect()->back()->with('success', $getBooking->users['fullname'].' booking reject');
    }

    public function reserveRequestArrive($id)
    {
        $getBooking = BookingAccumulator::findOrFail($id);
        
        $status = [
            'status' => 4
        ];
        $getBooking->update($status);
        //booking create notification
            $notification = [
                'fk_user_id' => $userId,
                'thread_id' => $getBooking->_id,
                'thread_type' => 'booking',
                'body_text' => 'Host finally your '.$getBooking->host_accumulator->place_name.' booking confirmed',
                'is_unread' => 0
            ];
            BookingNotification::create($notification);
        return redirect()->back()->with('success', $getBooking->users['fullname'].' booking reject');
    }

    public function reserveRequestPostpone($id)
    {
        $getBooking = BookingAccumulator::findOrFail($id);
        //check user exists in user booking room status
        $userId = $getBooking->fk_user_id;
        $checkUserExist = UserRoomBooking::checkUserExistsin($userId);
        $getUserBooking = UserRoomBooking::findOrFail($checkUserExist['_id']);
        //update booking info
        $requestRoom = $checkUserExist['user_not_come'] + 1;
        $user_not_come = [
            'user_not_come' => $requestRoom
        ];
        $getUserBooking->update($user_not_come);
        //end
        $status = [
            'status' => 5
        ];
        $getBooking->update($status);
        //booking create notification
            $notification = [
                'fk_user_id' => $userId,
                'thread_id' => $getBooking->_id,
                'thread_type' => 'booking',
                'body_text' => 'Host postponed your '.$getBooking->host_accumulator->place_name.' booking',
                'is_unread' => 0
            ];
            BookingNotification::create($notification);
        return redirect()->back()->with('success', $getBooking->users['fullname'].' booking reject');
    }


}
