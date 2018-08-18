<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class RoleWisePermission extends Eloquent
{
    protected $collection = 'roles_wise_permission';
    protected $fillable = ['fk_role_id', 'fk_permission_id'];

    public static function checkExistsRole($roleId,$permissionID){
        $result= DB::collection('roles_wise_permission')
        ->where('fk_role_id', '=', $roleId)
        ->where('fk_permission_id', '=', $permissionID)
        ->get();
        if(count($result)>0){
            return true;
        }
        return false;
    }
    public static function createRoleWisePermission($roleId,$permissionID){
        $result= DB::collection('roles_wise_permission')
        ->insert([
            'fk_role_id'=>$roleId,
            'fk_permission_id'=>$permissionID,
            'created_at'=>date('Y-m-d h:i:s')
            ]);
        if($result){
            return true;
        }
        return false;
    }

    public static function checkExistsPermission($permissionID){
        $result= DB::collection('roles_wise_permission')
        ->where('fk_permission_id', '=', $permissionID)
        ->get();
        return $result;
    }

    
    public static function deleteRolePermission($id,$permission){
        //print_r($permission);exit;
        
        for ($i=0; $i <count($permission) ; $i++) {
        $result = DB::collection('roles_wise_permission')
            ->where('fk_permission_id', $permission[$i])  // find your user by their id
            ->delete();
        }
    }
}
