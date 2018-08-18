<?php

namespace App\Http\Controllers\Frontend;

use App\Events\SubComments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\UserProfileImage;
use App\Models\PostComment;

use App\Models\PostSubComment;
use App\Models\FeedNotification;
use Auth;
use Validator;
use DB;
class PostSubCommentController extends Controller
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
        $subCommentData = PostSubComment::create($input)->_id;
        //crated notification
        
        $getComment = PostComment::findOrFail($input['fk_post_comment_id']);
        $input['thread_id'] = $getComment->fk_post_id;
        $input['thread_type'] = 'post subcomment ';
        
        $input['body_text'] = 'comment on '.$input['comment'];
        $input['focus'] = 'si_com_'.$input['fk_post_comment_id'];
        $input['is_unread'] = 0;
        FeedNotification::create($input); 


        $subComment = PostSubComment::findOrFail($subCommentData);
        broadcast(new SubComments($subComment))->toOthers();
        return $subComment;
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
        $input = $request->all();
        $subComId  = $input['subComId'];

        
        $getSubComment = PostSubComment::findOrFail($subComId);
        $getSubComment->update($input);
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
        PostSubComment::deleteSubComment($id);
        return $id;
        
    }
}
