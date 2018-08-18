<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\Models\PostSubComment;
class PostSubComment extends Eloquent
{
    public $with = ['users'];

    protected $collection = 'post_sub_comment';
    protected $fillable = ['fk_post_comment_id','sub_comment_type','comment','fk_user_id'];

    /*public static function insertPostSubComment($input){
        
        return DB::collection('post_sub_comment')
        ->insertGetId([
            'fk_post_comment_id' => $input['commentId'],
            'fk_user_id' => $input['userId'],
            'comment' => $input['text'],
            'sub_comment_type' => 0,
            'created_at' => date('Y-m-d h:i:s')
            ]); 
    }*/

    public function post_comment(){
        return $this->belongsTo('App\Models\PostComment','fk_post_comment_id');
    }

    public function users(){
        return $this->belongsTo('App\User','fk_user_id');
    }

    public static function commentIdWiseSubComment($id){
        
        return PostSubComment::where('fk_post_comment_id', $id)
        ->orderBy('_id','asc')
        ->get(); 
    }

    public static function deleteSubComment($id){
        return PostSubComment::where('_id', $id)->delete();
    }

    public static function checkUserSubComment($id){
        return PostLike::select('fk_user_id')
        ->where('fk_post_comment_id', $id)
        ->where('fk_user_id','!=',\Auth::user()->_id)
        ->get();
    }

    
}
