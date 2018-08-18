<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Validator;
use Response;
use DB;
use Hash;
class SettingsController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth','checkstatus']);
    }

    public function index()
    {
    	
    	return view('frontend.settings.index');
    }

    public function checkPassword(Request $request)
    {
    	$input = $request->all();
    	$id = Auth::user()->_id;
    	$user = User::findOrFail($id);

        if(!Hash::check($input['password'],$user->password)){
            return 'no';
        }else{
            return 'yes';
        }
    	
    }

    public function updateInfo(Request $request)
    {
        $input = $request->all();
        $id = Auth::user()->_id;
        $user = User::findOrFail($id);
        //return $user;
        if($input['firstname'] !==null && $input['lastname'] !==null && $input['phone'] !==null && $input['email'] !==null){
            $user->update($input);
            return "yes";
        }else{
            return "no";
        }
    }

    public function changeInfo(Request $request)
    {
    	$input = $request->all();

    	$id = Auth::user()->_id;
    	$user = User::findOrFail($id);
        $result = new User();
        if(isset($input['phone'])){
            $user->phone = $input['phone'];
            $dataUpdate = 'Phone Number ';
        }elseif(isset($input['address'])){
            $user->address = $input['address'];
            $dataUpdate = 'Address ';
        }elseif(isset($input['email'])){
            $user->email = $input['email'];
            $dataUpdate = 'Email ';
        }elseif(isset($input['interests'])){

            $interest = json_encode($input['interests']);
            $user->interests = $interest;
            $dataUpdate = 'Interests ';
        }elseif(isset($input['prefers'])){

            $prefer = json_encode($input['prefers']);
            $user->prefers = $prefer;
            $dataUpdate = 'Prefers ';
        }elseif(isset($input['intos'])){

            $into = json_encode($input['intos']);
            $user->intos = $into;
            $dataUpdate = 'into ';
        }elseif(isset($input['inspiration'])){
            $user->inspiration = $input['inspiration'];
            $dataUpdate = 'Inspiration ';
        }
        
        try {
            $user->save();
            $result->status = 'success';
            $result->message = $dataUpdate.'Updated Successfully'; 
            return $result;   
        } catch (\Exception $e) {
            $result->status = 'danger';
            $result->message = 'something went wrong please try again';
            return $result;
            
        }
        
        
        
    }

    public function updatePassword(Request $request)
    {
    	$input = $request->all();
    	$id = Auth::user()->_id;
    	$user = User::findOrFail($id);
    	$result = new User();
    	if(!Hash::check($input['old_password'],$user->password)){
    		$result->status = 'danger';
    		$result->message = 'The specified password does not match the database password';
    		return $result;
            
        }elseif ($input['new_password'] != $input['cnew_password']) {
        	$result->status = 'danger';
    		$result->message = 'Passwords Do Not Match';
    		return $result;
            
        }else{
            $user->password = bcrypt($input['new_password']);
            $user->save();
            $result->status = 'success';
    		$result->message = 'Your New Password is Now Set';
    		return $result;
            
        }
        
    }
}
