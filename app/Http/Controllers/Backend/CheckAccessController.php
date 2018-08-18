<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use Validator;
use Hash;
use DB;
class CheckAccessController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
        parent::__construct();
    }


    public function checkAccess(Request $request, $adminId, $type){
    	$id = $request['id'];
    	$data = Admin::findOrFail($id);
        $password = $request['password'];
        //type 0= change status, 1= edit, e 2=change password,3=delete.
        if($type=='0'){
        	$url = "user-admin-status/$adminId";
        }elseif($type =='1'){  
        	$url = "user-admin/$adminId/edit";
        }elseif($type =='2'){
        	$url = "user-admin-change-password/$adminId";
        }elseif($type =='3'){
        	$url = "user-admin-delete/$adminId";
        }else{
        	return redirect()->back()->with('error','Something Error Found !, Please try again.');
        }

        try {
            if(Hash::check($password,$data['password'])){
	         	$bug = 0;  
	        }else{
	            $bug = 1;
	        }
            
            //DB::commit();
        } catch (\Exception $e) {
            //DB::rollback();
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            
            return redirect("$url")->with('success','Successfully Log.');
        }else{
            return redirect()->back()->with('error','Password not match !, Please try again.');
        }
        
    }
}
