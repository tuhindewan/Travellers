<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminPost;
use App\AdminPostTag;
use App\AdminPostImage;
use App\AdminPostVideo;
use App\Models\Role;
use Validator;
use DB;
use App\Models\Announcement;
use App\Admin;
use Illuminate\Support\Facades\Input;
class AnnouncementController extends Controller
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
        $getData = Announcement::all();
        //return $getData;
        return view('backend.announcement.all_announcement', compact('getData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('backend.announcement.create_announcement');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the data

        $input  = $request->all();
        if($request->has('status')){
            $input['status'] ='1';
            
        }else{
            $input['status'] ='0';
        }
       
        //return $input;

        $rules = [
            'description'=>'required|maxWord:250',
            'start_date_time'=>'required',
            'last_date_time'=>'required'
        ];


        $messages = [
            'description' => "The Announcement Must Be Less Than 250 Words", 
            'start_date_time' => "Start Date Field is Required",
            'last_date_time' => "Last Date Field is Required",
        ];

        $validator = Validator::make($input,$rules,$messages);

        if ($validator->fails()) {

            return redirect('admin-announcement/create')
                        ->withErrors($messages)
                        ->withInput();
        }

        

        try {

            $id = Announcement::create($input);
            $bug = 0;

        } catch (Exception $e) {

            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
            
        }

        if($bug == 0){
            
            return redirect()->back()->with('success','Your Announcement Has Been Created Successfully.');
        }else{
            return redirect()->back()->with('error','Something Went Wrong !, Please Try Again.'.$bug1);
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
        $data = Announcement::findOrFail($id);

        $user = Announcement::getAdminByPostId($id);
        //return $user;

        return view('backend.announcement.show', compact('data','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Announcement::findOrFail($id);

        return view('backend.announcement.edit', compact('data'));
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
        // Validate the data


        $input  = $request->all();

        if($request->has('status')){
            $input['status'] ='1';
            
        }else{
            $input['status'] ='0';
        }
        



        $validator = Validator::make($request->all(), [
                    'description'=>'required|maxWord',
                    'description.maxWord' => "max words reached",
                    'start_date_time'=>'required',
                    'last_date_time'=>'required',
                ]);

        if ($validator->fails()) {

            return redirect('admin-announcement/create')
                        ->withErrors($validator)
                        ->withInput();
        }


        try {

            $id = Announcement::updateAnnouncement($input,$id);
            $bug = 0;

        } catch (Exception $e) {

            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
            
        }

        if($bug == 0){
            
            return redirect()->back()->with('success','Your Announcement Has Been Updated Successfully.');
        }else{
            return redirect()->back()->with('error','Something Went Wrong !, Please Try Again.'.$bug1);
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

            $getData = Announcement::findOrFail($id);
            //return $getData;

            $getData->delete();
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }

        if($bug == 0){
            return redirect()->back()->with('success','Announcement Deleted Successfully ');
        }elseif($bug == 1451){
                return redirect()->back()->with('error','This Announcement Id Used AnyWhere.');
            }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }
    }

    public function status($id)
    {
        $getPost = Announcement::findOrFail($id);
        if($getPost->status=='0'){
            $status = 1;
        }else{
            $status = 0; 
        }
        try {
            // update admin collection
            $getPost->update([
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
