<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\Models\PostCommentLike;

class PostCommentLike extends Eloquent
{
	public $with = ['users'];

    protected $collection = 'post_comment_like';
    protected $fillable = ['fk_comment_id','fk_user_id','liked_by'];

    public static function insertPostCommentLike($input){
        
        return DB::collection('post_comment_like')
        ->insertGetId([
            'fk_comment_id' => $input['commentId'],
            'fk_user_id' => $input['userId'],
            'liked_by' => 0,
            'created_at' => date('Y-m-d h:i:s')
            ]); 
    }

    public function post_comment(){
        return $this->belongsTo('App\Models\PostComment','fk_comment_id');
    }

    public function users(){
        return $this->belongsTo('App\User','fk_user_id');
    }

    public static function existsPostcommentLike($input){
    	return PostCommentLike::where('fk_user_id',$input['userId'])
    	->where('fk_comment_id',$input['commentId'])
    	->first();
    }

    public static function getCommentLike($commentId){
    	return PostCommentLike::where('fk_comment_id',$commentId)
    	->get();
    }

    public static function checkUserCommentLike($id){
        return PostLike::select('fk_user_id')
        ->where('fk_comment_id', $id)
        ->where('fk_user_id','!=',\Auth::user()->_id)
        ->get();
    }
}
