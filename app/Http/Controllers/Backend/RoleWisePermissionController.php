<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RoleWisePermission;
use Validator;
use DB;
class RoleWisePermissionController extends Controller
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
        $getRole = Role::where('status','1')->get();
        $getRoleWisePermission = RoleWisePermission::all();
        return view('backend.role_wise_permission.index', compact('getRole','getRoleWisePermission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'fk_role_id' => 'required',
            'fk_permission_id' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->all();

        $roleId = $request->fk_role_id;
        $permissionId = $request->fk_permission_id;
        $permission = $request->permission;
        
        
        try {
            
            /*delete role wise permission in rolewisepermission table*/
            $deletePermission = RoleWisePermission::deleteRolePermission($roleId,$permission);
            /*insert role wise permission in rolewisepermission table*/    
            for($i=0;$i<count($permissionId);$i++){

            $searchPermissionId = RoleWisePermission::checkExistsPermission($permissionId);
            $searchRoleId = RoleWisePermission::checkExistsRole($roleId,$permissionId[$i]);
            /*check role wise permission in rolewisepermission table*/
            if($searchRoleId===true){
                    
                }else{
                    RoleWisePermission::createRoleWisePermission($roleId,$permissionId[$i]);
                }
            }
            $bug = 0;

        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            
            return redirect()->back()->with('success','New RoleWisePermission Created Successfully.');
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
        /*Load all active permission show*/


        $getPermission = Permission::where('status','1')->get();
        $getRoleWisePermissions = RoleWisePermission::where('fk_role_id',$id)->get();
        
        return view('backend.role_wise_permission.load_permission', compact('getPermission','getRoleWisePermissions'));
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
        $getRoleWisePermission = RoleWisePermission::findOrFail($id);
        $validator = Validator::make($request->all(),[
                'RoleWisepermission_name' => 'required'

        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        
        try {
            $getRoleWisePermission->update($input);
            
            $bug = 0;
            
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            return redirect()->back()->with('success','RoleWisepermission Updated Successfully.');
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
        $getRoleWisePermission = RoleWisePermission::findOrFail($id);
        
        try {
            $getRoleWisePermission->delete();
            
            $bug = 0;
            
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            return redirect()->back()->with('success','RoleWisepermission Deleted Successfully.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }
    }
}
