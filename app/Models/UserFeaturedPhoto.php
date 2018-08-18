<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class UserFeaturedPhoto extends Eloquent
{
    protected $collection = 'user_featured_photo';
    protected $fillable = ['fk_user_id','image'];

    public static function checkExistImage($image)
    {
    	return DB::collection('user_featured_photo')
    	->where('fk_user_id', \Auth::user()->_id)
    	->where('image', $image)
    	->first();
    }

    public static function insertFeaturedImage($image)
    {
    	return DB::collection('user_featured_photo')
    	->insert([
    		'fk_user_id' => \Auth::user()->_id,
    		'image' => $image,
    		'created_at' => date('Y-m-d h:i:s')
    		]);
    }
}
