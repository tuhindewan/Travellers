<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class AdminWiseRole extends Eloquent
{
    
    protected $collection = 'admin_wise_roles';
    protected $fillable = ['fk_admin_id', 'fk_role_id'];

    public static function getAdminWiseRole($adminId){
        
        return DB::collection('admin_wise_roles')
        ->where('fk_admin_id',$adminId)
        ->first();  
    }

    public static function createAdminWiseRole($insertId, $input){
        
        return DB::collection('admin_wise_roles')
        ->insert([
            'fk_admin_id' => $insertId,
            'fk_role_id' => $input['fk_role_id'],
            'created_at' => date('Y-m-d h:i:s')
            ]); 
    }

    public static function updatedAdminWiseRole($id, $input){
        
        return DB::collection('admin_wise_roles')
        ->where('_id',$id)
        ->update([
            'fk_admin_id' => $input['adminId'],
            'fk_role_id' => $input['fk_role_id'],
            'updated_at' => date('Y-m-d h:i:s')
            ]); 
    }

    public static function deleteAdminWiseRole($id){
        
        return DB::collection('admin_wise_roles')
        ->where('_id',$id)
        ->delete(); 
    }

    
}
