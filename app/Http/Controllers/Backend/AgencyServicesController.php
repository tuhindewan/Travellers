<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AgencyServices;
use Auth;
use Validator;
use DB;
use Image;
use App\User;
class AgencyServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authId = Auth::user()->_id;
        $getServices = AgencyServices::where('fk_agency_id',$authId)->orderBy('position','desc')->paginate(10);
        return view('backend.agencies.services.view', compact('varname','getServices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.agencies.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'service_name' => 'required',
            'description'  => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        

        $input = $request->all();
        if(isset($input['status']) && $input['status']=='on'){
            
            $input['status'] = 1;
        }else{
            $input['status'] = 0;
        }
        $input['fk_agency_id']  = Auth::user()->_id;
        $getService = AgencyServices::where('fk_agency_id',$input['fk_agency_id'])->orderBy('position','desc')->first();
        if(count($getService) > 0){
            $input['position'] = $getService->position+1;
        }else{
            $input['position'] = 1;
        }
        
        
        if ($request->hasFile('image')) {
            $photo=$request->file('image');
            $fileType=substr($_FILES['image']['type'], 6);
             $fileName   = '/'.date("Y/m/d").'/'.rand(1,1000).date('dmyhis').".".$fileType;
            $upload     = $photo->move('images/agency/services'.'/'.date("Y/m/d").'/',$fileName);
            $input['image']=$fileName;
            
        }
        
        try {
            
            AgencyServices::create($input);
            $bug = 0;
            //DB::commit();
        } catch (\Exception $e) {
            //DB::rollback();
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            
            return redirect()->back()->with('success','New Service create Successfully.');
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
        //
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
        $validator = Validator::make($request->all(),[
            'service_name' => 'required',
            'description'  => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $getService = AgencyServices::findOrFail($id);

        $input = $request->all();
        
        
        if ($request->hasFile('image')) {
            $photo=$request->file('image');
            $fileType=substr($_FILES['image']['type'], 6);
            $fileName   = '/'.date("Y/m/d").'/'.rand(1,1000).date('dmyhis').".".$fileType;
            $upload     = $photo->move('images/agency/services'.'/'.date("Y/m/d").'/',$fileName);
            $input['image']=$fileName;
            $img_path='images/agency/services/'.$getService['image'];

            if($getService['image']!=null and file_exists($img_path)){
                unlink($img_path);
            }
        }else{
            $input['image']=$getService['image'];    
        }
        
        try {
            // update services collection
            $getService->update($input);
            
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
        $getService = AgencyServices::findOrFail($id);

        try {
            
            $img_path='images/agency/services/'.$getService['image'];

            if($getService['image']!=null and file_exists($img_path)){
                unlink($img_path);
            }
            
            
            $getService->delete();
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            return redirect()->back()->with('success','Deleted Successfully ');
        }elseif($bug == 1451){
                return redirect()->back()->with('error','This Admin Id Used AnyWhere.');
            }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }
    }
}
