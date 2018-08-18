<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AgencyGallery;
use Auth;
use Validator;
use DB;
use Image;
use App\User;
class AgencyGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authId = Auth::user()->_id;
        $getGallery = AgencyGallery::where('fk_agency_id', $authId)->orderBy('_id','desc')->get();

        return view('backend.agencies.gallery.index', compact('getGallery'));
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
            'file'        => 'required',
            'type'        => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $input = $request->all();
        $input['fk_agency_id']  = Auth::user()->_id;
        
        try {
            
            AgencyGallery::create($input);
            $bug = 0;
            //DB::commit();
        } catch (\Exception $e) {
            //DB::rollback();
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            
            return redirect()->back()->with('success','New file upload Successfully.');
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
        $getGallery = AgencyGallery::findOrFail($id);

        try {
            
            $img_path='images/agency/gallery/'.$getGallery['file'];

            if($getGallery['file']!=null and file_exists($img_path)){
                unlink($img_path);
            }
            
            
            $getGallery->delete();
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            return redirect()->back()->with('success','Deleted Successfully ');
        }elseif($bug == 1451){
                return redirect()->back()->with('error','This Data Id Used AnyWhere.');
            }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }
    }

    public function imageUpload(Request $request)
    {
        $input = $request->all();
        $imageData = $input['file'];
        $main = 'images/agency/gallery/';
        if (preg_match('/data:image\/(gif|jpeg|png);base64,(.*)/i', $imageData, $matches)) {
            $imageType = $matches[1];
            $imageData = base64_decode($matches[2]);

            $image = imagecreatefromstring($imageData);
            $filename = md5($imageData) . '.png';

            
            $img = Image::make($imageData);
                    
            $imageName = rand(1,1000).date('dmyhis').".png";
            /*auto*480 size image */
            $directory = $main.date("Y").'/'.date("m").'/'.date("d").'/';

            //If the directory doesn't already exists.
            if(!is_dir($directory)){
                //Create our directory.
                mkdir($directory, 755, true);
            }
            $img->resize(null, 480, function ($constraint) {
                $constraint->aspectRatio();
                //$constraint->upsize();
            });
            $save_path = date("Y").'/'.date("m").'/'.date("d").'/'.$imageName;
            $img->save($main.$save_path);
          
          }
          
          return $save_path;
        
        
    }

    public function videoUpload(Request $request)
    { 
        $input = $request->all();
        $videoData = $input['file'];
        $data = array(); 
        try {
            if (preg_match('/data:video\/(mp4|3gp|webm|mpeg|ogg|mov|flv|avi|wmv|3gpp);base64,(.*)/i', $videoData, $matches)) {
                $imageType = $matches[1];
                $imageData = base64_decode($matches[2]);

                $filename = md5($imageData) . '.mp4';
                $directory = 'images/agency/gallery/'.date("Y").'/'.date("m").'/'.date("d").'/';

                //If the directory doesn't already exists.
                if(!is_dir($directory)){
                    //Create our directory.
                    mkdir($directory, 755, true);
                }
                $save_path = date("Y").'/'.date("m").'/'.date("d").'/'.$filename;
                $path = 'images/agency/gallery/'.date("Y").'/'.date("m").'/'.date("d").'/'.$filename;
                file_put_contents($path, $imageData);
                $fileSize = filesize($path);
                if($fileSize <= 19914376){
                    $data['type'] = 'success';
                    $data['result'] = $save_path;
                    return $data;
                }else{
                    if(file_exists($path)){
                        unlink($path);
                    }
                    $data['type'] = 'error';
                    $data['result'] = "File size upto 20MB";
                    return $data; 
                }
            }else{
                $data['type'] = 'error';
                $data['result'] = "This video format not allowed";
                return $data;
            }    
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
            $data['type'] = 'error';
            $data['result'] = "Something Error Found !, Please try again. ".$bug1;
            return $data;
        }
        
    }

    public function removeFile(Request $request)
    {
        $input = $request->all();
        
        $path = $input['file'];
        
        $img_path = 'images/agency/gallery/'.$input['file'];
        
        if(file_exists($img_path)){
            unlink($img_path);
        }
        return "success";  
    }
}
