<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class Permission extends Eloquent
{
    protected $collection = 'permission';
    protected $fillable = ['permission_name', 'status'];

    public static function createPermission($input){
    	 
		return DB::collection('permission')
    	->insert([
    		'permission_name' => $input['permission_name'],
    		'status' => $input['status'],
    		'created_at' => date('Y-m-d h:i:s')
    		]);

    	
    	
    	
    }
}
