<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\AdminWiseRole;
use App\Models\Permission;
use App\Models\AdminProfileImage;
use App\Admin;
use Validator;
use DB;

class UserAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getUser = Admin::all();
        //$getUsers = Admin::getUserAdminWiseRole();
        //return $getUsers;
        $getAdminWiseRole = AdminWiseRole::all();
        $getRole = Role::all();
        return view('backend.user-admin.index',compact('getUser','getAdminWiseRole','getRole'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $getRole = Role::where('status', '1')->get();
        return view('backend.user-admin.create', compact('getRole'));
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
            'email'         => 'email|required|unique:admin',
            'password'      => 'required|min:6|confirmed',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->all();

        $input['password'] = bcrypt($input['password']);
        
        //DB::beginTransaction();
            
            
        try {
            $insertId = Admin::create($input)->_id;

            AdminWiseRole::createAdminWiseRole($insertId, $input);
            $bug = 0;
            //DB::commit();
        } catch (\Exception $e) {
            //DB::rollback();
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            
            return redirect('user-admin')->with('success','New Users Sign Up Successfully.');
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
    public function show($id)
    {
        $getAdmin = Admin::findOrFail($id);
        $getAdminProfile = AdminProfileImage::checkExtProfile($id);
        $getAdminProfileset = AdminProfileImage::admin();
        $getRoleId = AdminWiseRole::getAdminWiseRole($id);
        
        $getRole = Role::getRoleWiseRole($getRoleId['fk_role_id']);
        return view('backend.user-admin.view', compact('getAdmin','getRole','getAdminProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getAdmin = Admin::findOrFail($id);
        //$getProfile = AdminProfile::findOrFail($id);
        $getRoleId = AdminWiseRole::getAdminWiseRole($id);
        $getRole = Role::where('status','1')->get();
        $getAdminProfile = AdminProfileImage::checkExtProfile($id);
        $accessRole = Role::getRoleWiseRole($getRoleId['fk_role_id']);
        return view('backend.user-admin.edit', compact('getAdmin','getRole','accessRole','getAdminProfile'));
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

        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'email'    => 'email|required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $getAdmin = Admin::findOrFail($id);
        $getAdminProfile = AdminProfileImage::checkExtProfile($id);

        $input = $request->all();
        //return $input;
        $input['adminId']  = $id;
        
        if ($request->hasFile('image')) {
            $photo=$request->file('image');
            $fileType=substr($_FILES['image']['type'], 6);
             $fileName   = '/'.date("Y/m/d").'/'.rand(1,1000).date('dmyhis').".".$fileType;
            $upload     = $photo->move('images/admin'.'/'.date("Y/m/d").'/',$fileName);
            $input['image']=$fileName;
            $img_path='images/admin/'.$getAdminProfile['image'];

            if($getAdminProfile['image']!=null and file_exists($img_path)){
                unlink($img_path);
            }
        }else{
            $input['image']=$getAdminProfile['image'];    
        }
        
        try {
            // update admin collection
            $getAdmin->update($input);
            //check extsis admin image and if no extsis then insert else update
            if(count($getAdminProfile)>0){
                AdminProfileImage::updateAdminProfileImage($getAdminProfile['_id'], $input);
            }else{
                AdminProfileImage::uploadAdminProfileImage($id, $input);
            }
            //update admin role
            $getRoleId = AdminWiseRole::getAdminWiseRole($id);
            if(count($getRoleId) > 0){

                AdminWiseRole::updatedAdminWiseRole($getRoleId['_id'], $input);
            }else{
                 AdminWiseRole::createAdminWiseRole($id, $input);
            }

            $bug = 0;
            //DB::commit();
        } catch (\Exception $e) {
            //DB::rollback();
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            
            return redirect()->back()->with('success','Updated Successfully.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
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

        $getAdmin = Admin::findOrFail($id);

        try {
            //delete this admin role
            $getAdminWiseRole = AdminWiseRole::getAdminWiseRole($id);
            AdminWiseRole::deleteAdminWiseRole($getAdminWiseRole['_id']);
            //delete this admin profile image on admin profile image collection
            $getAdminProfile = AdminProfileImage::checkExtProfile($id);
            $img_path='images/admin/'.$getAdminProfile['image'];

            if($getAdminProfile['image']!=null and file_exists($img_path)){
                unlink($img_path);
            }
            
            AdminProfileImage::deleteAdminProfileImage($getAdminProfile['_id']);
            //delete this admin from admin collection
            $getAdmin->delete();
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            return redirect()->back()->with('success','User Admin Deleted Successfully ');
        }elseif($bug == 1451){
                return redirect()->back()->with('error','This Admin Id Used AnyWhere.');
            }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }
    }

    /**
     * Change Password the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePasswordView($id)
    {
        $getAdmin = Admin::findOrFail($id);

        return view('backend.user-admin.change_password', compact('getAdmin')); 
    }

    public function changePasswordUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'password'      => 'required|min:6|confirmed'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $getAdmin = Admin::findOrFail($id);
        
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        try {
            // update admin collection
            $getAdmin->update($input);
            $bug = 0;
            //DB::commit();
        } catch (\Exception $e) {
            //DB::rollback();
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            
            return redirect()->back()->with('success','Password Change Successfully.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }   
    }
    /**
     * Status the specified from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $getAdmin = Admin::findOrFail($id);
        if($getAdmin->status=='1'){
            $status = 0;
        }else{
            $status = 1; 
        }
        try {
            // update admin collection
            $getAdmin->update([
                'status'=>$status
                ]);
            $bug = 0;
            //DB::commit();
        } catch (\Exception $e) {
            //DB::rollback();
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            
            return redirect()->back()->with('success','Status Change Successfully.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        } 
    }
}
