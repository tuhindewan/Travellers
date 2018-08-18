<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\Models\ImageLike;
class ImageLike extends Eloquent
{
    public $with = ['users'];
    protected $collection = 'image_like';
    protected $fillable = ['fk_image_id','fk_user_id','liked_by'];


    public function post_image(){
        return $this->belongsTo('App\Models\PostImages','fk_image_id');
    }

    public static function existsUserImageLike($input){
        
        return ImageLike::where('fk_image_id', $input['fk_image_id'])
        ->where('fk_user_id', $input['fk_user_id']) 
        ->first(); 
    }

    public static function getImageIdWise($imageId){
        
        return ImageLike::where('fk_image_id', $imageId)->get(); 
    }

    public function users(){
        return $this->belongsTo('App\User','fk_user_id');
    }
}
