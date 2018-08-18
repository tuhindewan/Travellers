<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\Models\PostComment;
class PostComment extends Eloquent
{
    public $with = ['post_sub_comment','users','post_comment_like'];

    protected $collection = 'post_comment';
    protected $fillable = ['fk_post_id','fk_user_id','comment_by','comment'];

    /*public static function insertUserPostWiseComment($input){
        
        return DB::collection('post_comment')
        ->insertGetId([
            'fk_post_id' => $input['fk_post_id'],
            'fk_user_id' => $input['fk_user_id'],
            'comment' => $input['comment'],
            'comment_by' => 0,
            'created_at' => date('Y-m-d h:i:s')
            ]); 
    }*/

    public function posts(){
        return $this->belongsTo('App\Models\Posts','fk_post_id');
    }

    public function users(){
        return $this->belongsTo('App\User','fk_user_id');
    }

    public function post_sub_comment(){
        return $this->hasMany('App\Models\PostSubComment','fk_post_comment_id');
    }

    public function post_comment_like(){
        return $this->hasMany('App\Models\PostCommentLike','fk_comment_id');
    }

    public static function postIdWiseComment($id){
        
        return PostComment::where('fk_post_id', $id)
        ->orderBy('_id','asc')
        ->get(); 
    }


    public static function checkUserComment($id){
        return PostComment::select('fk_user_id')
        ->where('fk_post_id', $id)
        ->where('fk_user_id','!=',\Auth::user()->_id)
        ->get();
    }

    // public static function deleteUserPostWiseComment($id){
        
    //     return DB::collection('post_comment')
    //     ->where('_id',new \MongoDB\BSON\ObjectID($id))
    //     ->delete();; 
    // }
}
