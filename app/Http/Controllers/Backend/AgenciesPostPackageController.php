<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AgenciesPost;
use App\Models\AgenciesPostImage;
use App\Models\CountryPlace;
use Auth;
use Validator;
use DB;
use Image;
use App\User;
class AgenciesPostPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type = null)
    {
      $authId = Auth::user()->_id;
        if($type=='post'){
            $post_type = '1';
        }elseif($type=='package'){
            $post_type = '2';
        }else{
            return '404';
        }

        $getPost = AgenciesPost::where('fk_agency_id',$authId)->where('post_type',$post_type)->orderBy('_id','desc')->paginate(10);

        return view('backend.agencies.post_package.view', compact('getPost','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type = null)
    {
        return view('backend.agencies.post_package.create', compact('type'));
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
            'place' => 'required'
            
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
        
        $input['fk_agency_id'] = Auth::user()->_id;
        /*check exist country place in db*/
        $checkPlace = CountryPlace::checkExistPlace($input);
        if(count($checkPlace)>0){
            $input['fk_place_id'] = $checkPlace['_id'];
        }else{
            $placeId = CountryPlace::createCountryPlace($input);
            $input['fk_place_id'] = $placeId;
        }
        //return $input;
        try {
            //agency post create
            $input['fk_post_id'] = AgenciesPost::create($input)->_id;
            $postImageCount = count($input['images']);

            if($postImageCount > 0){
                for ($a=0; $a < $postImageCount; $a++) {
                    $input['images'] = $input['images'][$a];
                    AgenciesPostImage::create($input);   
                }
            }

            
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        if($bug == 0){
            return redirect()->back()->with('success',' Upload Successfully.');
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

    public function imageUpload(Request $request)
    {
        $input = $request->all();
        $imageData = $input['image'];
        $main = 'images/agency/post_package/photo/';
        $thum =  'images/agency/post_package/photo/thum/';
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

            /*thum size image */
            $directoryThum = $thum.date("Y").'/'.date("m").'/'.date("d").'/';

            //If the directory doesn't already exists.
            if(!is_dir($directoryThum)){
                //Create our directory.
                mkdir($directoryThum, 755, true);
            }
            $img->resize(null, 243, function ($constraint) {
                $constraint->aspectRatio();
                //$constraint->upsize();
            });
            $save_path = date("Y").'/'.date("m").'/'.date("d").'/'.$imageName;
            $img->save($thum.$save_path);
          
          }
          
          return $save_path;
        
        
    }

    public function imageRemove(Request $request)
    {
        $input = $request->all();
        
        $path = $input['path'];
        $thum_path = $path.'thum/'.$input['image'];
        $img_path = $path.$input['image'];
        if(file_exists($thum_path)){
            unlink($thum_path);
        }
        if(file_exists($img_path)){
            unlink($img_path);
        }
        return "success";  
    }
}
