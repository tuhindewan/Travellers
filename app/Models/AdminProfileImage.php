<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//use Illuminate\Database\Eloquent\Model;
use DB;
class AdminProfileImage extends Eloquent
{
    protected $collection = 'admin_profile_image';
    protected $fillable = ['image', 'fk_admin_id'];


    public static function checkExtProfile($adminId){
    	 
		return DB::collection('admin_profile_image')
    	->where('fk_admin_id',$adminId)
    	->first();

    }

    public static function uploadAdminProfileImage($adminId,$input){
    	 
		return DB::collection('admin_profile_image')
    	->insert([
    		'fk_admin_id' => $adminId,
    		'image' => $input['image'],
    		'created_at' => date('Y-m-d h:i:s')
    		]);

    }

    public static function updateAdminProfileImage($id,$input){
    	 
		return DB::collection('admin_profile_image')
		->where('_id',$id)
    	->update([
    		'fk_admin_id' => $input['adminId'],
    		'image' => $input['image'],
    		'updated_at' => date('Y-m-d h:i:s')
    		]);

    }

    public static function deleteAdminProfileImage($id){
    	 
		return DB::collection('admin_profile_image')
		->where('_id',$id)
    	->delete();

    }

    public static function admin(){
        //return $this->belongsTo('App\Admin');
    }

}
