<?php

namespace App\Http\Controllers\Frontend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\UserCoverImage;
use Auth;
use Validator;
use DB;
use Image;
use App\Models\Posts;
use App\Models\UserProfileImage;
use App\Models\PostImages;
use App\Models\PostLike;
use App\Models\PostComment;
use App\Models\PostSubComment;

class CoverImageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','checkstatus']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        
        if($request->hasFile('coverimage')){
            $photo      = $request->file('coverimage');
            $fileType   = substr($_FILES['coverimage']['type'], 6);
            $fileName   = '/'.date("Y/m/d").'/'.rand(1,1000).date('dmyhis').".".$fileType;
            $upload     = $photo->move('images/users'.'/'.date("Y/m/d").'/',$fileName);
            $input['coverimage'] = $fileName;
            $user_id = Auth::user()->_id;
            $imageId = UserCoverImage::userCreateCoverImage($input,$user_id);
            $insert = User::insertCoverId($imageId,$user_id);
            $getCover = UserCoverImage::getCoverImageById($user_id);
            $user_info = User::findOrFail($user_id);

            $posts  = Posts::getPostData($user_id);
            $getUserProfile = UserProfileImage::all();
            $getUserInfo = User::getUserBasicInfo();
            $getPostWiseImage = PostImages::all();
            /*return $getPostWiseImage;*/
            $getPostLike = PostLike::checkMyLikeOnPost($user_id);
            $getPostComment = PostComment::orderBy('_id','desc')->get();
            $getSubComment = PostSubComment::orderBy('_id','asc')->get();
            $myProfile = UserProfileImage::singleUserWiseProfile($user_id);
            $getUserName = User::select('_id','username')->get();

                return view('frontend.user.index',compact('user_info','getCover','posts','getUserProfile','getUserInfo','getPostWiseImage','getPostLike','getPostComment','getSubComment','myProfile','getUserName'));
            
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
        //
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
        //
    }
}
