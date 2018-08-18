<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminPost;
use App\Admin;
use App\Models\SuperAdmin;
use Validator;
use Hash;
use DB;
class UserAccessController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
        parent::__construct();
    }


    public function UserAccess(Request $request, $userId, $type){
    	$adminId = $request['adminId'];
        $data = Admin::findOrFail($adminId);
        $password = $request['password'];
        //type 0= change status, 1= delete
        if($type=='0'){
        	$url = "user-status/$userId";
        }elseif($type =='1'){
        	$url = "user-delete/$userId";
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
