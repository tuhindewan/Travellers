<?php

namespace App\Http\Controllers\Frontend;

use App\Events\Comments;
use App\Events\CommentLike;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\UserProfileImage;
use App\Models\Posts;
//use App\Notifications\Feeds;
use App\Models\PostComment;
use App\Models\FeedNotification;
use App\Models\PostCommentLike;
use App\Models\PostSubComment;
use Auth;
use Validator;
use DB;
use Image;
class PostCommentController extends Controller
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
        $input = $request->all();
        $input['fk_user_id'] = Auth::user()->_id;
        $type = $input['type'];
        //comment insert
        $commentData = PostComment::create($input)->_id;
        //$commentData = PostComment::insertUserPostWiseComment($input);
        
        $getPost =Posts::findOrFail($input['fk_post_id']);
        $count = $getPost->hits_count;

        $data['hits_count'] = $count+1;
        $getPost->update($data);

        //crated notification
        $input['thread_id'] = $input['fk_post_id'];
        $input['thread_type'] = 'post comment';
        if($getPost['description'] !== null){
            $description = str_limit($getPost['description'], 50). '...';
        }else{
            $description = 'this post';
        }
        $input['body_text'] = 'comment on '. $description;
        $input['focus'] = 'si_com_'.$commentData;
        $input['is_unread'] = 0;
        FeedNotification::create($input);

        $comment = PostComment::findOrFail($commentData);
        broadcast(new Comments($comment))->toOthers();
        return $comment;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$getComment = PostComment::postIdWiseComment($id,5);
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
        $commentId  = $input['commentId'];

        
        $getComment = PostComment::findOrFail($commentId);
        $getComment->update($input);
        return $input['comment'];


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        //sub comment delete
        
        $getSubCom = PostSubComment::commentIdWiseSubComment($id);
        if(count($getSubCom)>0){
            $numSubCom = count($getSubCom);
            for ($i=0; $i < $numSubCom; $i++) { 
                $subComment = PostSubComment::findOrFail($getSubCom[$i]->_id);
                $subComment->delete();   
            }
        }

        //comment like delete
        $getCommentLike = PostCommentLike::getCommentLike($id);
        if(count($getCommentLike)>0){
            $numLikeCom = count($getCommentLike);
            for ($i=0; $i < $numLikeCom; $i++) { 
                $commentLike = PostCommentLike::findOrFail($getCommentLike[$i]->_id);
                $commentLike->delete();   
            }
        }

        //comment delete
        $getComment = PostComment::findOrFail($id);
        $getComment->delete();
        
        $getPost =Posts::findOrFail($getComment->fk_post_id);
        $count = $getPost->hits_count;

        $data['hits_count'] = $count-1;
        $getPost->update($data); 
        return $id;
    }


    public function allComment($id){
        
        $getComment = PostComment::postIdWiseComment($id);
        $getUserProfile = UserProfileImage::all();
        $getUserName = User::select('_id','username')->get();
        return view('frontend.newsfeed.post.load-all-comment',compact('getComment','getUserProfile','getUserName'));
    }

    public function commentLike(Request $request)
    {
        
        $input = $request->all();
        $status = $input['status'];
        $commentId  = $input['commentId'];
        
        if($status==0){
            PostCommentLike::insertPostCommentLike($input);

            //crated notification
            $input['fk_user_id'] = Auth::user()->_id;
            $getComment = PostComment::findOrFail($commentId);
            $input['thread_id'] = $getComment->fk_post_id;
            $input['thread_type'] = 'post comment like';
            
            $input['body_text'] = 'like on post comment';
            $input['focus'] = 'si_com_'.$commentId;
            $input['is_unread'] = 0;
            FeedNotification::create($input); 
        }else{
            $getExists = PostCommentLike::existsPostcommentLike($input); 
            $getExists->delete();
        }
        
        $getCommentLike = PostCommentLike::getCommentLike($input['commentId']);
        broadcast(new CommentLike($getCommentLike))->toOthers();
        return $getCommentLike;
        

    }
}
