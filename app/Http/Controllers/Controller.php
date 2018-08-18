<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\AdminWiseRole;
use App\Models\Permission;
use App\Models\AdminProfileImage;
use App\Models\WebSettings;
use App\Admin;
use Auth;
use User;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            if(empty($request)){
                $id = Auth::user()['_id'];     
                
            }else{
                if(($this->middleware('auth:admin'))){
                    $id = Auth::user()['_id'];
                    $getAdminProfile = AdminProfileImage::checkExtProfile($id);
                    $userImage = $getAdminProfile['image'];
                    $getRoleId = AdminWiseRole::getAdminWiseRole($id);
                    $getRole = Role::getRoleWiseRole($getRoleId['fk_role_id']);
                    $role_name = $getRole['role_name'];

                    $commonData = array(
                        'image' => $userImage,
                        'role_name' => $role_name,
                        'web_settings' => WebSettings::first()
                    ); 

                    \Session::put('commonData',$commonData);    
                }
                
                
                
                return $next($request);   
            }
        });
        
    	
    }
}
