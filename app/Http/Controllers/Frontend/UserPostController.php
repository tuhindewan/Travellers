<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\UserProfileImage;
use App\Events\PostLikes;
use App\Models\Posts;
use App\Models\PostVideos;
use App\Models\PostImages;
use App\Models\CountryPlace;
use App\Models\PostLike;
use App\Models\PostComment;
use App\Models\PostSubComment;
use App\Models\PostCommentLike;
use App\Models\Relationship;
use App\Models\FeedNotification;
use Auth;
use Validator;
use DB;
use Image;
class UserPostController extends Controller
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
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "hi";
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
            'post_type' => 'required',
            'lat' => 'required',
            'lon' => 'required'
        ]);

        if($validator->fails()){
            return 'error';
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->all();
        
        $input['fk_user_id'] = Auth::user()->_id;   
        try {
            /*check exist country place in db*/
            $checkPlace = CountryPlace::checkExistPlace($input);
            if(count($checkPlace)>0){
                $input['fk_place_id'] = $checkPlace['_id'];
            }else{
                $placeId = CountryPlace::createCountryPlace($input);
                $input['fk_place_id'] = $placeId;
            }
            $input['hits_count'] = 0;
            $input['status'] = 1;

            $postId = Posts::create($input)->_id;

            /*image upload section*/
            if(!empty($input['image'])){
                for ($i=0; $i < count($input['image']); $i++) { 
                    $imageData = $input['image'][$i];
                    PostImages::insertPostImages($postId,$imageData);    
                }
            }
            
            /*video upload section*/
            // if(!empty($input['video'])){
            //     for ($i=0; $i < count($input['video']); $i++) { 
            //         $videoLink = $input['video'][$i]; 

            //         PostVideos::insertPostVideos($postId,$videoLink);  
            //     }
            // }
            $bug = 0;
            //DB::commit();
        } catch (\Exception $e) {
            //DB::rollback();
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            return 'success';
            return redirect()->back()->with('success','Post Upload Successfully.');
        }else{
            return "success";
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
        $getPost =Posts::findOrFail($id);
        $count = $getPost->hits_count;

        $data['hits_count'] = $count+1;
        $getPost->update($data);

        return json_encode($getPost);
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
        $postId  = $input['postId'];

        //comment delete
        $postData = Posts::findOrFail($postId);
        $postData->update($input);
        $getPost = Posts::findOrFail($postId);
        $getUserProfile = UserProfileImage::where('fk_user_id',new \MongoDB\BSON\ObjectID($getPost['fk_user_id']))->first();
        $getUserName = User::where('_id',$getPost['fk_user_id'])->select('_id','username')->first();

        return view('frontend.newsfeed.post.post-edit',compact('getUserProfile','getUserName','getPost'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $getComment = PostComment::postIdWiseComment($id);
        $commentCount = count($getComment);
        if($commentCount > 0 ){
            for ($i=0; $i < $commentCount; $i++) { 

                //sub comment delete
                $getSubCom = PostSubComment::commentIdWiseSubComment($getComment[$i]->_id);
                if(count($getSubCom)>0){
                    $numSubCom = count($getSubCom);
                    for ($c=0; $c < $numSubCom; $c++) { 
                        $subComment = PostSubComment::findOrFail($getSubCom[$c]->_id);
                        $subComment->delete();   
                    }
                }
                //end sub comment delete

                //comment like delete
                $getCommentLike = PostCommentLike::getCommentLike($getComment[$i]->_id);
                if(count($getCommentLike)>0){
                    $numLikeCom = count($getCommentLike);
                    for ($l=0; $l < $numLikeCom; $l++) { 
                        $commentLike = PostCommentLike::findOrFail($getCommentLike[$l]->_id);
                        $commentLike->delete();   
                    }
                }
                //end comment like delete

                //comment delete
                $getComment = PostComment::findOrFail($getComment[$i]->_id);
                $getComment->delete();

                //end comment delete

            }    
        }


        //post image delete
        $getPostImage = PostImages::getImageByPostId($id);
        //return $getPostImage;
        $postImgCount = count($getPostImage);
        if($postImgCount > 0){
            for ($m=0; $m < $postImgCount; $m++) { 
                $postImg = PostImages::findOrFail($getPostImage[$m]['_id']);
                $img_thum = 'images/post/photo/thum/'.$postImg->images;
                $img_path = 'images/post/photo/'.$postImg->images;
                
                if($postImg->images != null and file_exists($img_thum)){
                    unlink($img_thum);
                    unlink($img_path);
                }
                $postImg->delete();   
            }
        }

        //end post image delete

        //post like delete
        $getPostLike = PostLike::getPostLike($id);
        $postLike = count($getPostLike);
        if($postLike > 0){
            for ($p=0; $p < $postLike; $p++) { 
                $pLike = PostLike::findOrFail($getPostLike[$p]->_id);
                $pLike->delete();    
            }
        }
        //end post like delete

        //post delete
        $getPost = Posts::findOrFail($id);
        $getPost->delete();
        //end post delete
        
        return $id;
    }

    /**
     * post like section .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postLike(Request $request)
    {
        $input = $request->all();
        $status = $input['status'];
        $postId  = $input['postId'];
        $getPost =Posts::findOrFail($postId);
        $count = $getPost->hits_count;
        if($status==0){
            PostLike::insertUserPostWiseLike($input);
            
            $data['hits_count'] = $count+1;
            $getPost->update($data);

            //crated notification
            $input['fk_user_id'] = Auth::user()->_id;
            $input['thread_id'] = $postId;
            $input['thread_type'] = 'post like';
            if($getPost['description'] !== null){
                $description = str_limit($getPost['description'], 50). '...';
            }else{
                $description = 'this post';
            }
            $input['body_text'] = 'like on '. $description;
            $input['focus'] = 'like_love_'.$postId;
            $input['is_unread'] = 0;
            FeedNotification::create($input);
            
        }else{
            $getExists = PostLike::existsUserPostWiseLike($input); 
            PostLike::deleteUserPostWiseLike($getExists['_id']); 
            $data['hits_count'] = $count-1;
            $getPost->update($data);  
        }
        

        $getPostLike = PostLike::getPostLike($postId);
        broadcast(new PostLikes($getPostLike))->toOthers();
        return $getPostLike;
        

    }


    public function likeCount(){
        return PostLike::all();    
    }

 

    public function userWisePost($userId)
    {
        $getPosts = Posts::getUserWisePost($userId);

        return json_encode($getPosts); 
    }

    public function userWiseTypePost($userId, $type)
    {
        $getPosts = Posts::getUserWiseTypePost($userId, $type);

        return json_encode($getPosts); 
    }

    public function singlePost($userName, $postId)
    {

        $getPost = Posts::findOrFail($postId);
        $getTypePost = Posts::where('post_type',$getPost->post_type)->where('_id', '!=', $postId)->orderBy('hits_count','desc')->take(10)->get();
        
        return view('frontend.post.index',compact('getPost','getTypePost'));
    }

}
