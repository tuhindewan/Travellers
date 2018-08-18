<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\Models\PostImages;
use Auth;
class PostImages extends Eloquent
{
    public $with = ['image_like','image_comment'];
    protected $collection = 'post_image';
    protected $fillable = ['fk_post_id', 'images'];

    public static function insertPostImages($postId,$image){
        return DB::collection('post_image')
        ->insert([
            'fk_post_id' => $postId,
            'images' => $image,
            'created_at' => date('Y-m-d h:i:s')
            ]); 
    }

    public function posts(){
        return $this->belongsTo('App\Models\Posts','fk_post_id');
    }

    public function image_like(){
        return $this->hasMany('App\Models\ImageLike','fk_image_id');
    }

    public function image_comment(){
        return $this->hasMany('App\Models\ImageComment','fk_image_id');
    }

    public static function getImageByPostId($id){
        return  DB::collection('post_image')->where('fk_post_id', $id)->select('_id')->get();
    }
    // public static function getImageByUserId($logged_id){
    //     return PostImages::where('fk_user_id',$logged_id)->orderBy('created_at','desc')->get();
    // }

    public static function getPostImagesByPostId($id)
    {
        return PostImages::where('fk_post_id', new \MongoDB\BSON\ObjectID($id))->get();
    }
}
