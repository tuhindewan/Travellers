<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\Models\PostLike;
class PostLike extends Eloquent
{
    public $with = ['users'];
    protected $collection = 'post_like';
    protected $fillable = ['fk_post_id','fk_user_id','liked_by'];

    public static function insertUserPostWiseLike($input){
        
        return DB::collection('post_like')
        ->insert([
            'fk_post_id' => $input['postId'],
            'fk_user_id' => $input['userId'],
            'liked_by' => 0,
            'created_at' => date('Y-m-d h:i:s')
            ]); 
    }

    public static function checkMyLikeOnPost($id){
        
        return DB::collection('post_like')
        ->where('fk_user_id', $id) 
        ->get(); 
    }

    public static function existsUserPostWiseLike($input){
        
        return DB::collection('post_like')
        ->where('fk_post_id', $input['postId'])
        ->where('fk_user_id', $input['userId']) 
        ->first(); 
    }

    public static function deleteUserPostWiseLike($id){
        
        return DB::collection('post_like')
        ->where('_id',new \MongoDB\BSON\ObjectID($id))
        ->delete();; 
    }

    public function posts(){
        return $this->belongsTo('App\Models\Posts','fk_post_id');
    }

    public function users(){
        return $this->belongsTo('App\User','fk_user_id');
    }

    public static function getPostLike($postId){
        return PostLike::where('fk_post_id',$postId)->get();
    }

    public static function checkUserLike($id){
        return PostLike::select('fk_user_id')
        ->where('fk_post_id', $id)
        ->where('fk_user_id','!=',\Auth::user()->_id)
        ->get();
    }
}
