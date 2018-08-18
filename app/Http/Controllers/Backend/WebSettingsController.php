<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WebSettings;
use Validator;
use DB;
class WebSettingsController extends Controller
{
    
    public function __construct() {

      
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
        $getWebSettings = WebSettings::first();
        return view('backend.settings.web_settings', compact('getWebSettings'));
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {

       

    }

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

        $getSettings = WebSettings::findOrFail($id);
        //return $getSettings;
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            //'address' => 'required',
            'email' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        
        /*logo image upload*/
        if($request->hasFile('logo')){
            $photo      = $request->file('logo');
            $fileType   = substr($_FILES['logo']['type'], 6);
            $fileName   = rand(1,1000).date('dmyhis').".".$fileType;
            $upload     = $photo->move('images/settings/web_settings'.'/',$fileName);
            $input['logo'] = $fileName;
        }
        /*logo image upload end*/

        /*fav icon image upload*/
        if($request->hasFile('fav_icon')){
            $photo      = $request->file('fav_icon');
            $fileType   = substr($_FILES['fav_icon']['type'], 6);
            $fileName   = rand(1,1000).date('dmyhis').".".$fileType;
            $upload     = $photo->move('images/settings/web_settings'.'/',$fileName);
            $input['fav_icon'] = $fileName;
        }
        /*fav icon image upload end*/
        try {
            $getSettings->update($input);
            
            $bug = 0;
            
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            return redirect()->back()->with('success','Web Settings Update Successfully.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! Please try again.'.$bug1);
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
       
    }
}
