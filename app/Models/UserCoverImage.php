<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//use Illuminate\Database\Eloquent\Model;
use DB;
class UserCoverImage extends Eloquent
{
    protected $collection = 'user_cover_image';
    protected $fillable = ['coverimage','fk_user_id'];

    public static function userCreateCoverImage($input,$user_id){
    	 
		return DB::collection('user_cover_image')
    	->insertGetId([
            'coverimage' => $input['coverimage'],
    		'fk_user_id' => $user_id,
    		'created_at' => date('Y-m-d h:i:s')
    		]);

    }

    public static function getCoverImageById($user_id){
        return  DB::collection('user_cover_image')->where('fk_user_id',$user_id)->orderBy('created_at', 'desc')->first();
    }


    public function userscover()
    {
        return UserCoverImage::belongsTo('App\User','fk_cover_id');
    }








}
