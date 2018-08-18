<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Posts;
use App\Models\PostImages;
use App\Models\UserProfileImage;
use App\Models\CurrentCity;
use App\Models\CountryPlace;
use Yajra\Datatables\Facades\Datatables;
use DB;
use Illuminate\Support\Facades\Input;
use App\Models\Reports;


class UserPostController extends Controller
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
        
        $title = "User's All Post";
        $postget = 0;
        return view('backend.userpost.all_user_post', compact('title','postget'));

    }

    public function request()
    {
        $postget = 1;
        $title = "User verification request post";
        return view('backend.userpost.all_user_post', compact('title','postget'));

    }
    public function verification()
    {
        $postget = 2;
        $title = "User verified post";
        return view('backend.userpost.all_user_post', compact('title','postget'));

    }

    public function active()
    {
        $postget = 3;
        $title = "User Active post";
        return view('backend.userpost.all_user_post', compact('title','postget'));

    }
    public function inactive()
    {
        $postget = 4;
        $title = "User Inactive post";
        return view('backend.userpost.all_user_post', compact('title','postget'));

    }
    public function postVerification($post)
    {
        $get = explode('-', $post);
        $postId = $get[0];
        $type =$get[1];
        $getPost = Posts::findOrFail($postId);
        if($type==0){
            $getPost->update(['posted_by'=>0]);
            return redirect()->back()->with('This post verification cancel');
        }else{
            $getPost->update(['posted_by'=>2]);
            return redirect()->back()->with('This post verified');
        }



    }

    public function postView($value)
    {
        if($value==0){

            $posts = Posts::orderBy('created_at', 'desc')->get();
        }elseif($value==1){
            $posts = Posts::where('posted_by',1)->orderBy('created_at', 'desc')->get();
        }elseif($value==2){
            $posts = Posts::where('posted_by',2)->orderBy('created_at', 'desc')->get();
        }elseif($value==3){
            $posts = Posts::where('status',1)->orderBy('created_at', 'desc')->get();
        }elseif($value==4){
            $posts = Posts::where('status',0)->orderBy('created_at', 'desc')->get();
        }
        
        return Datatables::of($posts)
            
            ->editColumn('user', function($posts){
                
             return $posts->users['fullname'];
            })
            ->editColumn('created_at', function($posts){
                
             return $posts->created_at->diffForHumans();
            })
            ->editColumn('post_type', function($posts){
                if($posts->post_type=='4'){
                    $postType ='experience'; 
                }elseif($posts->post_type=='3'){
                    $postType ='plan';
                }elseif($posts->post_type=='2'){
                    $postType ='question';
                }elseif($posts->post_type=='1'){
                    $postType ='suggestion';
                }
             return $postType;
            })

            ->editColumn('status', function($posts){
             return (($posts->status == 1)?"Active":"Inactive");
            })
            
            ->addColumn('action', '
                <div class="btn-group">

                    <a target="_blank" href=\'{{URL::to("user-post-admin/$_id")}}\' class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>

                    <a target="_blank" href=\'{{URL::to("user-post-admin/$_id/edit")}}\' class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                    &nbsp;&nbsp;
                    
                    <a type="submit" onclick="return confirmDelete();" class="btn btn-danger btn-sm">
                          <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </a>
                    
                </div>
                ')
            
            //->remove_column('action')
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $getPost = Posts::findOrFail($id);
        
        return view('backend.userpost.show',compact('getPost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getPost = Posts::findOrFail($id);
        //return $getPost;
        $getPlace = CountryPlace::findOrFail($getPost->fk_place_id);
        return view('backend.userpost.edit',compact('getPost','getPlace'));
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
        $getPost = Posts::findOrFail($id);
        if(isset($input['image'])){
            $imageCount = count($input['image']);
            for ($i=0; $i < $imageCount ; $i++) { 
                $getImage = PostImages::findOrFail($input['image'][$i]);
                $img_path = "images/post/photo/".$getImage['images'];
                $thum_path = "images/post/photo/thum/".$getImage['images'];
                if($getImage['images'] !=null){
                    unlink($img_path);
                    unlink($thum_path);
                }
                $getImage->delete();
            }
        }

        if(isset($input['status'])){

            $getReports = Reports::checkReport('post', $id);
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
        try {
            $getPost->update($input);
            if(isset($input['receive']) && $input['receive'] == 'ajax'){
                return "success";
            }
            $bug = 0;  
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];    
        }
        if($bug == 0){
            
            return redirect()->back()->with('success','Post Updated Successfully.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
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

            $getData = Posts::findOrFail($id);
            //return $getData;

            $getData->delete();
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }

        if($bug == 0){
            return redirect()->back()->with('success','Post Deleted Successfully ');
        }elseif($bug == 1451){
                return redirect()->back()->with('error','This Post Id Used AnyWhere.');
            }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }
    }

    public function status($id)
    {
        $getPost = Posts::findOrFail($id);
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
