<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AgencyAbout;
use App\Models\CountryPlace;
use App\Models\AgencySocial;
use App\Models\AgencyStory;
use Auth;
use Validator;
use DB;
use Image;
use App\User;
class AgencyAboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $authId = Auth::user()->_id;
        $getAbout = AgencyAbout::where('fk_agency_id',$authId)->first();

        $getAboutSocial = AgencySocial::where('fk_agency_id',$authId)->get();
        $getAboutStory = AgencyStory::where('fk_agency_id',$authId)->first();
        return view('backend.agencies.about.index', compact('getAbout', 'getAboutSocial', 'getAboutStory'));
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
        $validator = Validator::make($request->all(),[
            'agency_name'        => 'required',
            'place'              => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        

        $input = $request->all();
        
        $input['fk_agency_id']  = Auth::user()->_id;
        if($input['lon'] != '' && $input['lat'] != ''){
            $checkPlace = CountryPlace::checkExistPlace($input);
            if(count($checkPlace)>0){
                $input['fk_place_id'] = $checkPlace['_id'];
            }else{
                $placeId = CountryPlace::createCountryPlace($input);
                $input['fk_place_id'] = $placeId;  
            }
        }else{
           return redirect()->back()->with('error','Give the correct location'); 
        }


        //check agency from AgencyAbout table 
        $existsAbout = 0;
        $checkAbout = AgencyAbout::checkExistAgency(Auth::user()->_id);
        if(count($checkAbout) > 0){
            $getAbout = AgencyAbout::findOrFail($checkAbout['_id']);
            $existsAbout = 1;
        }

        //check agency from AgencyStory table 
        
        $existsStory = 0;
        if(isset($input['story_title'])){
            $checkStory = AgencyStory::checkExistAgencyStory(Auth::user()->_id);
            if(count($checkStory) > 0){
                $getStory = AgencyStory::findOrFail($checkStory['_id']);
                $existsStory = 1;
            }
        }

        if ($request->hasFile('agency_logo')) {
            $photo=$request->file('agency_logo');
            $fileType=substr($_FILES['agency_logo']['type'], 6);
            $fileName   = '/'.date("Y/m/d").'/'.rand(1,1000).date('dmyhis').".".$fileType;
            $upload     = $photo->move('images/agency/about'.'/'.date("Y/m/d").'/',$fileName);
            $input['logo']=$fileName;

            if($existsAbout == 1){
                $img_path='images/agency/about'.$getAbout['logo'];
                if($getAbout['logo']!=null and file_exists($img_path)){
                    unlink($img_path);
                }    
            }
            
        }else{
            if($existsAbout == 1){
                $input['logo'] = $getAbout->logo; 
            }
        }

        if ($request->hasFile('agency_cover_image')) {
            $photo=$request->file('agency_cover_image');
            $fileType=substr($_FILES['agency_cover_image']['type'], 6);
            $fileName   = '/'.date("Y/m/d").'/'.rand(1,1000).date('dmyhis').".".$fileType;
            $upload     = $photo->move('images/agency/about'.'/'.date("Y/m/d").'/',$fileName);
            $input['cover_image']=$fileName;

            if($existsAbout == 1){
                $img_path='images/agency/about'.$getAbout['cover_image'];
                if($getAbout['cover_image']!=null and file_exists($img_path)){
                    unlink($img_path);
                }    
            }
                
        }else{
            if($existsAbout == 1){
                $input['cover_image'] = $getAbout->cover_image; 
            }
        }

        /*story section*/
        
        if ($request->hasFile('story_image')) {
            $photo=$request->file('story_image');
            $fileType=substr($_FILES['story_image']['type'], 6);
            $fileName   = '/'.date("Y/m/d").'/'.rand(1,1000).date('dmyhis').".".$fileType;
            $upload     = $photo->move('images/agency/about'.'/'.date("Y/m/d").'/',$fileName);
            $input['story_image']=$fileName;

            if($existsStory == 1){
                $img_path='images/agency/about'.$getStory['story_image'];
                if($getStory['story_image']!=null and file_exists($img_path)){
                    unlink($img_path);
                }    
            }    
        }else{
            if($existsStory == 1){
                $input['story_image'] = $getStory->story_image; 
            }
        }


        try {
            //check exits 
            if($existsAbout == 1){
                $getAbout->update($input);
            }else{
                AgencyAbout::create($input);
            }
            //story section
            if(isset($input['story_title'])){
                if($existsStory == 1){
                    $getStory->update($input);
                }else{
                    AgencyStory::create($input);
                }
            }

            /*social link section update*/
            if(isset($input['social_id'])){
                $countId = count($input['social_id']);
                for ($l=0; $l < $countId; $l++) { 
                    $link = $input['link'][$l];
                    $social_name = $input['social_name'][$l];
                    $socialId =  $input['social_id'][$l];
                    AgencySocial::updateSocialData($socialId, $link, $social_name);
                }
            }
            /*social link section delete*/
            if(isset($input['exists_link_delete'])){
                $countDelete = count($input['exists_link_delete']);
                for ($l=0; $l < $countDelete; $l++) { 
                    $getSocialData = AgencySocial::findOrFail($input['exists_link_delete'][$l]);
                    $getSocialData->delete();
                }
            }

            /*social link section insert*/
            if(isset($input['add_account_link'])){
                $countLink = count($input['add_account_link']);
                for ($l=0; $l < $countLink; $l++) { 
                    $input['link'] = $input['add_account_link'][$l];
                    $input['social_name'] = $input['add_account'][$l];
                    AgencySocial::create($input);
                }
            }
            
            //

            $bug = 0;
            //DB::commit();
        } catch (\Exception $e) {
            //DB::rollback();
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            
            return redirect()->back()->with('success','About information successfully save.');
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
        //
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
}
