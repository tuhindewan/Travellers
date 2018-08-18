<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class Role extends Eloquent
{
    protected $collection = 'role';
    protected $fillable = ['role_name', 'status'];

    public static function createRole($input){
    	 
		return DB::collection('role')
    	->insert([
    		'role_name' => $input['role_name'],
    		'status' => $input['status'],
    		'created_at' => date('Y-m-d h:i:s')
    		]);
    }

    public static function getRoleWiseRole($roleId){
        
        return DB::collection('role')
        ->where('_id',$roleId)
        ->first();  
    }
}
