<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\UserProfileImage;
use App\Models\UserVerifi;
use App\Mail\UserVerifiMail;
use Auth;
use Validator;
use Response;
use DB;
class UserVerificationController extends Controller
{
    public function __construct()
    {
       // $this->middleware(['auth']);
    }

	public function view($id){
        //return $id;
        $input=array('id'=>$id);
        $validator = Validator::make($input,[
            'id' => 'exists:users,_id',
        ]);
        if($validator->fails()){
            return redirect('index');
        }
        $getUser = User::findOrFail($id);
        return view('frontend.user.user_match_validation', compact('getUser'));
    }

    /**/

    public function checkCode(Request $request){

        $input=$request->all();
        $id = $input['id'];

        $getUserVerifi = UserVerifi::getUserVerifiInfoInUserId($id);
        $verifiId = $getUserVerifi->_id;
        if(($getUserVerifi->code == $input['code']) && ($getUserVerifi->endTime <= date('Y-m-d h:i:s'))){

            try {
                
                User::userUpdateVerifiedStatus($id);
                UserVerifi::userWiseVerifiDelete($verifiId);
                
                $bug = 0;
                
            } catch (\Exception $e) {
                
                $bug = $e->errorInfo[1];
                $bug1 = $e->errorInfo[2];
            }
            
            if($bug == 0){
                return redirect('/')->with('success','New Users Sign Up Successfully.');
            }else{
                return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
            }
            /**/
        }else{
        	return redirect()->back()->with('error', "Do not match!");
        }
    }

    public function checkUser($value)
    {
        $check = User::where('username',$value)->orWhere('email',$value)->first();
        $result = new User();
        if(count($check)>0){
            $result->status = 'success';
            $result->userid = $check->_id;
        }else{
            $result->status = 'error';
            $result->userid = null;
        }
        return $result;
    }

    
}
