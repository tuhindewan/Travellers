<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//use Illuminate\Database\Eloquent\Model;
use DB;
class UserProfileImage extends Eloquent
{

    protected $collection = 'user_profile_image';
    protected $fillable = ['image'];

    public static function userCreateImage($input){
         
        return DB::collection('user_profile_image')
        ->insertGetId([
            'image' => $input['image'],
            'created_at' => date('Y-m-d h:i:s')
            ]);

    }

    public function users() {
        return $this->belongsTo('App\User','fk_image_id');
    } 

    

    public static function singleUserWiseProfile($userId){
        return  DB::collection('user_profile_image')->where('fk_user_id', new \MongoDB\BSON\ObjectID($userId))->first();
    }

    public static function getImageId($userId)
    {
        return  DB::collection('user_profile_image')->select('_id')->where('fk_user_id', new \MongoDB\BSON\ObjectID($userId))->first();
    }

    public static function getImageById($image_id)
    {
        return DB::collection('user_profile_image')->where('_id',new \MongoDB\BSON\ObjectID($image_id))->first();
    }


}
