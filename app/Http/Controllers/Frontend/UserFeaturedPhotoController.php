<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserFeaturedPhoto;
use App\User;
use Auth;
use Validator;
use DB;
use Image;

class UserFeaturedPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $input = $request->all();
        
        try {
            if($input['type']==1){
                $newImage = $input['newImage'];
                
                $removeImage = $input['removeImage'];

                // check remove image and delete in database
                for ($r=0; $r < count($removeImage); $r++) { 
                   
                    $checkExist = UserFeaturedPhoto::checkExistImage($removeImage[$r]);
                    if(count($checkExist) > 0){
                    
                        $getFeatured = UserFeaturedPhoto::findOrFail($checkExist['_id']);
                        $getFeatured->delete();        
                    }
                }
                
                //insert new image in database
                //return $newImage;
                for ($i=0; $i < count($newImage); $i++) { 
                    $checkExist = UserFeaturedPhoto::insertFeaturedImage($newImage[$i]);    
                }

                $getFeaturedPhoto = UserFeaturedPhoto::where('fk_user_id', \Auth::user()->_id)->get();
                return json_encode($getFeaturedPhoto);
            }    
            
        } catch (\Exception $e) {
            return 'error';
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
        $getPhoto = UserFeaturedPhoto::where('fk_user_id',$id)->get();
        return json_encode($getPhoto);
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
