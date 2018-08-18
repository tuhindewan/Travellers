<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

use App\Models\CurrentCity;

use App\Models\CountryPlace;
use App\Models\Posts;
use Yajra\Datatables\Facades\Datatables;
use DB;
use Illuminate\Support\Facades\Input;
use App\Models\Reports;
use App\Models\UserRoomBooking;

class UserListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getUser = User::orderBy('_id', 'DESC')->get();
        return view('backend.all_user.index',compact('getUser'));
    }

    public function userView(Request $request)
    {
        
        
        $getUser = User::orderBy('created_at', 'desc')->get();

        return Datatables::of($getUser)
           
            ->editColumn('created_at', function($getUser){
                
             return $getUser->created_at->diffForHumans();
            })
            ->editColumn('status', function($getUser){
             return (($getUser->status == 1)?"Active":"Inactive");
            })
            ->addColumn('action', '
                <div class="btn-group">

                    <a target="_blank" href=\'{{URL::to("all_user/$_id")}}\' class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                    
                    <a type="submit" onclick="return confirmDelete();" class="btn btn-danger btn-sm">
                          <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </a>
                    
                </div>
                ')
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user_info = User::findOrFail($id);
        $userBookingStatus = UserRoomBooking::where('fk_user_id',$id)->first();
        
        $getPosts = Posts::getUserWiseTypePost($id, '4');
        $getPlaceId = Posts::getUserWisePostPlaceId($id,'4');
        //return $getPlaceId;
        $markers = array();
        if(count($getPlaceId) > 0){

            foreach ($getPlaceId as $placeId) {
                $getPlace = CountryPlace::findOrFail($placeId);
                $place = new CountryPlace();
                $place->id = $getPlace->_id;
                $place->position = new CountryPlace();
                $place->position->lat = doubleval($getPlace->lat);
                $place->position->lng = doubleval($getPlace->lon);
                $place->infoText=$getPlace->place_name;
                $markers[] = $place;
            }
        }
        //echo "<pre>";
        // print_r(($getPosts[0]['post_image']));exit;
        //$postImages = PostImages::getImageByUserId($id);
        return view('backend.all_user.show',compact('user_info','getPosts','markers','userBookingStatus'));
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
        $input = $request->all();
        if(isset($input['status'])){

            $getReports = Reports::checkReport('user', $id);
            $reportCount = count($getReports);
            if($input['status']==0){
                $rStatus = 2;
            }else{
                $rStatus = 1;
            }
            for ($i=0; $i < $reportCount; $i++) {
               $getReport = Reports::findOrFail($getReports[$i]['_id']);
               $getReport->update(['status'=> $rStatus]);
            }
        }
        $getUser = User::findOrFail($id);
        $getUser->update($input);
        if(isset($input['receive']) && $input['receive'] == 'ajax'){
            return "success";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $getData = User::findOrFail($id);
            //return $getData;

            $getData->delete();
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }

        if($bug == 0){
            return redirect()->back()->with('success','User Deleted Successfully ');
        }elseif($bug == 1451){
                return redirect()->back()->with('error','This User Id Used AnyWhere.');
            }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }
    }

    public function status($id)
    {
        $getUser = User::findOrFail($id);
        if($getUser->status=='0'){
            $status = 1;
        }else{
            $status = 0; 
        }
        try {
            // update admin collection
            $getUser->update([
                'status'=>$status
                ]);
            $bug = 0;
            //DB::commit();
        } catch (\Exception $e) {
            //DB::rollback();
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            
            return redirect()->back()->with('success','Status Change Successfully.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }
    }
}
