<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\UserProfileImage;
use App\Models\UserVerifi;
use App\Mail\UserVerifiMail;
use App\Models\CurrentCity;
use Auth;
use Validator;
use Response;
use DB;
use Hash;
use Image;
class UsersController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['auth','checkstatus']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       //$location = \Location::get();
        $ip = '43.224.116.54';
        //$ip= \Request::ip();
        $data = \Location::get($ip);
        //$position = \Location::get('192.168.0.105');
        echo "<pre>";
        print_r($data);exit;


                                                   
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentCity = CurrentCity::where('status','1')->get();
        return view('frontend.user.sign-up',compact('currentCity'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*validator all field*/
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'email'         => 'email|required|unique:users',
            'password'      => 'required|min:6|confirmed',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->all();
        
        /*call user verifi code and time*/
        $result = $this->userVerifiCodeTime();
        $code = $result['code'];
        $request->code = $code;
        $endTime = $result['endTime'];
        //echo "<pre>";print_r($input);exit;
        
        if($request->hasFile('image')){
            //$photo      = $request->file('image');

            // $fileType   = substr($_FILES['image']['type'], 6);
            // $fileName   = '/'.date("Y/m/d").'/'.rand(1,1000).date('dmyhis').".".$fileType;
            // $upload     = $photo->move('images/users'.'/'.date("Y/m/d").'/',$fileName);
            // $input['image'] = $fileName;


            $img = Image::make($input['image']);
            $fileType   = substr($_FILES['image']['type'], 6);          
            $imageName = '/'.date("Y/m/d").'/'.rand(1,1000).date('dmyhis').".".$fileType;
            

            /*160*auto size image */
            $directory = 'images/users/profile/s160/'.date("Y").'/'.date("m").'/'.date("d").'/';

            //If the directory doesn't already exists.
            if(!is_dir($directory)){
                //Create our directory.
                mkdir($directory, 755, true);
            }
            
            //$img->resize(160, null);
            $img->resize(160, null, function ($constraint) {
                $constraint->aspectRatio();
                //$constraint->upsize();
            });
            
            $img->save('images/users/profile/s160/'.$imageName);

            /*80*auto size image */
            $directory = 'images/users/profile/s80/'.date("Y").'/'.date("m").'/'.date("d").'/';

            //If the directory doesn't already exists.
            if(!is_dir($directory)){
                //Create our directory.
                mkdir($directory, 755, true);
            }
            
            //$img->resize(80, null);
            $img->resize(80, 80, function ($constraint) {
                $constraint->aspectRatio();
                //$constraint->upsize();
            });
            
            $img->save('images/users/profile/s80/'.$imageName);

            $input['profile_image'] =$imageName;
        }else{
            if($input['gender']=='Mr'){
                $defaultImage = '/mr.jpg';
            }else{
                $defaultImage = '/mrs.png';
            }
            $input['profile_image'] = $defaultImage;
        }
        
        $input['password'] = bcrypt($input['password']);
        //DB::beginTransaction();
            

            //$imageId = UserProfileImage::userCreateImage($input);
            $userId = User::userSignUp($input);
            UserVerifi::userVerification($userId, $code, $endTime);
           
            //\Mail::send(new UserVerifiMail());
            Auth::loginUsingId($userId);
        try {
            $bug = 0;
            //DB::commit();
        } catch (\Exception $e) {
            //DB::rollback();
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            
            return redirect('users/account-verification/'.$userId)->with('success','New Users Sign Up Successfully.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {

        //check username in database
        $check = User::where('username',$username)->first();
        if(count($check)>0){
            return 'yes';
        }else{
            return 'no';
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type = $request['type'];

        if ($type == 0) {

            $data = $request->all();
            


            $user = User::findOrFail($id);

            if(!Hash::check($data['currentPass'],$user->password)){
                return redirect()->back()->with('error','The specified password does not match the database password');
            }elseif ($data['newPassword'] != $data['conPassword']) {
                return redirect()->back()->with('error','Passwords Do Not Match');
            }else{
                $user->password = bcrypt($data['newPassword']);
                $user->save();
                return redirect()->back()->with('success','Your New Password is Now Set');
            }

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

    /*re generate code form user email*/
    public function reGenerateCode(Request $request){
        //return "hi";
        $input=$request->all();
        $id = $input['id'];
        
        $getUserVerifi = UserVerifi::getUserVerifiInfoInUserId($id);
        $verifiId = $getUserVerifi->_id;
        /*call user verifi code and time*/
        $result = $this->userVerifiCodeTime();
        $code = $result['code'];
        $request->code = $code;
        $endTime = $result['endTime'];

        try {
            UserVerifi::userVerificationCodeUpdate($verifiId, $code, $endTime);
            \Mail::send(new UserVerifiMail());
            $bug = 0;
            //DB::commit();
        } catch (\Exception $e) {
            //DB::rollback();
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            return "success";
        }else{
            return 'Something Error Found !, Please try again.'.$bug1;
        }
    }

    public function userInfo($id)
    {
        $getUser = User::findOrFail($id);
        return json_encode($getUser);
    }

    public function updateProfilePicture(Request $request)
    {
        $input = $request->all();
        $authInfo = User::findOrFail(Auth::user()->_id);
        /*160*auto size image */
        $directory = 'images/users/profile/s160/'.date("Y").'/'.date("m").'/'.date("d").'/';

        //If the directory doesn't already exists.
        if(!is_dir($directory)){
            //Create our directory.
            mkdir($directory, 755, true);
        }
        if($request->hasFile('img')){
            $photo      = $request->file('img');
            $picture    = Image::make($request->file('img'));
            $fileType   = substr($_FILES['img']['type'], 6);
            $fileName   = '/'.date("Y/m/d").'/'.rand(1,1000).date('dmyhis').".".$fileType;
            $upload     = $photo->move($directory,$fileName);

            $data['profile_image'] = $fileName;

            $img_path160='images/users/profile/s160/'.$authInfo['profile_image'];
            $img_path80='images/users/profile/s80/'.$authInfo['profile_image'];
            if($authInfo['profile_image']!=null and file_exists($img_path160)){
                unlink($img_path160);
            }
            if($authInfo['profile_image']!=null and file_exists($img_path80)){
                unlink($img_path80);
            }
            /*80*auto size image */
            $directory = 'images/users/profile/s80/'.date("Y").'/'.date("m").'/'.date("d").'/';

            //If the directory doesn't already exists.
            if(!is_dir($directory)){
                //Create our directory.
                mkdir($directory, 755, true);
            }
            
            //$img->resize(80, null);
            $picture->resize(80, 80, function ($constraint) {
                $constraint->aspectRatio();
                //$constraint->upsize();
            });
            
            $picture->save('images/users/profile/s80/'.$fileName);

            $authInfo->update($data);
        }else{
            $data['profile_image'] = 'images/users/profile/s160/'.$authInfo['profile_image'];  
        }

        print_r(json_encode($data['profile_image']));

    }
    public function updateCoverPicture(Request $request)
    {
        $input = $request->all();
        $authInfo = User::findOrFail(Auth::user()->_id);
        $directory = 'images/users/cover/'.date("Y").'/'.date("m").'/'.date("d").'/';
        if($request->hasFile('img')){
            $photo      = $request->file('img');
            $fileType   = substr($_FILES['img']['type'], 6);
            $fileName   = '/'.date("Y/m/d").'/'.rand(1,1000).date('dmyhis').".".$fileType;
            $upload     = $photo->move($directory,$fileName);

            $data['cover_image'] = $fileName;

            $img_path='images/users/cover/'.$authInfo['cover_image'];
            
            if($authInfo['cover_image']!=null and file_exists($img_path)){
                unlink($img_path);
            }
            
            $authInfo->update($data);
        }else{
            $data['cover_image'] = 'images/users/cover/'.$authInfo['cover_image'];  
        }

        print_r(json_encode($data['cover_image']));

    }
    
}
