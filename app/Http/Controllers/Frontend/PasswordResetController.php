<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Mail\PasswordReset;
use Mail;
class PasswordResetController extends Controller
{
    public function index()
    {
    	# code...
    }

    public function userIdentify(Request $request)
    {
    	$input = $request->all();
    	if(!empty($input)){
    		$check = User::where('username',$input['userdata'])->orWhere('email',$input['userdata'])->first();
    		if(count($check)>0){
	          	return redirect('password-recover/'.$check->_id);	  
	        }else{
	            return redirect('login-identify')->with('error','No search results');
	        }
    	}else{

    		return view('Frontend/password-reset/login-identify');
    	}
    }

    public function recover($id)
    {
    	$getUser = User::findOrFail($id);
    	return view('Frontend/password-reset/password-recover',compact('getUser'));
    }

    public function recoverMethod(Request $request)
    {
        $getUser = $request->all();
        $digits = 6;
        $code = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $user = User::findOrFail($getUser['token_id']);
        //$request = new User;
        $request->email = $user['email']; 
        $request->code = $code; 
        
        \Session::put($getUser['token_id'], $code);

        \Mail::send(new PasswordReset());
        return redirect('recover-method-code?_token='.$getUser['_token'].'&receive_code='.$getUser['receive_code'].'&token_id='.$getUser['token_id']);
        //return view('Frontend/password-reset/recover-send-code',compact('getUser'));
    }

    public function recoverMethodCode(Request $request)
    {
    	$getUser = $request->all();
    	
    	return view('Frontend/password-reset/recover-send-code',compact('getUser'));
    }

    public function setPassword(Request $request)
    {
    	$input = $request->all();
        $data = \Session::get($input['security_id']);
        if($input['verification-code'] == $data){
            return view('Frontend/password-reset/set-password', compact('input'));
        }else{
            return redirect()->back()->with('error',"Warning  The number that you've entered doesn't match your code. Please try again.");
        }
    	
    }

    public function confirmPassword(Request $request)
    {
    	$input = $request->all();
    	$id = $input['security_id'];
        $user = User::findOrFail($id);
        if(strlen($input['password']) < 5 ){
            return redirect()->back()->with('error','Passwords must be at least 6 characters long'); 
        }
        try {
            if ($input['password'] != $input['c_password']) {
                return redirect()->back()->with('error','Passwords Do Not Match');
            }else{
                $user->password = bcrypt($input['password']);
                $user->save();
                \Auth::loginUsingId($id);
                return redirect('/');
            }
            
        } catch (\Exception $e) {
           return redirect()->back()->with('error','Something Error Found !, Please try again.'); 
        }
    	
    }

    public function userVerifiCodeTime(){
        /* get tomorrow date time*/
        $datetime = new \DateTime(date('Y-m-d h:i:s'));
        $datetime->modify('+1 day');
        $endTime = $datetime->format('Y-m-d H:i:s');
        /* get rand dom genarat code in user verification*/
        $digits = 4;
        $code = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $result = [
            'code' => $code,
            'endTime' => $endTime
        ];
        return $result;
    }
}
