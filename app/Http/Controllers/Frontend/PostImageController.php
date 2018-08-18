<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\User;

use App\Models\Posts;
use App\Models\PostImages;
use App\Models\ImageLike;
use App\Models\ImageComment;
use App\Models\ImgCommentLike;
use Auth;
use Validator;
use DB;
use Image;
class PostImageController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth','checkstatus']);
    }

 	public function index()
    {
        return 'hi';
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
      $imageData = $input['image'];

      try {
        if($input['type'] == '1'){
          if (preg_match('/data:image\/(gif|jpeg|png);base64,(.*)/i', $imageData, $matches)) {
            $imageType = $matches[1];
            $imageData = base64_decode($matches[2]);

            $image = imagecreatefromstring($imageData);
            $filename = md5($imageData) . '.png';

            
            $img = Image::make($imageData);
                    
            $imageName = rand(1,1000).date('dmyhis').".png";
            /*auto*480 size image */
            $directory = 'images/post/photo/'.date("Y").'/'.date("m").'/'.date("d").'/';

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
            $img->save('images/post/photo/'.$save_path);

            /*thum size image */
            $directory = 'images/post/photo/thum/'.date("Y").'/'.date("m").'/'.date("d").'/';

            //If the directory doesn't already exists.
            if(!is_dir($directory)){
                //Create our directory.
                mkdir($directory, 755, true);
            }
            $img->resize(null, 243, function ($constraint) {
                $constraint->aspectRatio();
                //$constraint->upsize();
            });
            $save_path = date("Y").'/'.date("m").'/'.date("d").'/'.$imageName;
            $img->save('images/post/photo/thum/'.$save_path);
          
          }
          return $save_path;
        }else{
          $thum_path = 'images/post/photo/thum/'.$input['image'];
          $img_path = 'images/post/photo/'.$input['image'];
          if(file_exists($thum_path)){
            unlink($thum_path);
          }
          if(file_exists($img_path)){
            unlink($img_path);
          }
          return "success";
        }
          
      } catch (\Exception $e) {
         return "error"; 
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

 	public function imageLike(Request $request)
    {
        $input = $request->all();
        $status = $input['status'];
        $imageId  = $input['fk_image_id'];
        $getImage = PostImages::findOrFail($imageId);
        $getPost = Posts::findOrFail($getImage->fk_post_id);
        $count = $getPost->hits_count;
        $checkImageLike = ImageLike::existsUserImageLike($input);
        if($status==0 && count($checkImageLike) == 0){
            ImageLike::create($input);
            
            $data['hits_count'] = $count+1;
            $getPost->update($data);
            
        }else{
            if(count($checkImageLike)>0){

            	$checkImageLike->delete(); 
            	$data['hits_count'] = $count-1;
            	$getPost->update($data);
            }
            
              
        }
        
        
        $getImageLike = ImageLike::getImageIdWise($imageId);
        //broadcast(new PostLikes($getImage))->toOthers();
        return json_encode($getImageLike);
        

    } 

    public function imageComment(Request $request)
      {
      	$input = $request->all();
        $input['fk_user_id'] = Auth::user()->_id;
        
        // image comment insert
        $commentData = ImageComment::create($input)->_id;

        $getImage = PostImages::findOrFail($input['fk_image_id']);
        $getPost =Posts::findOrFail($getImage->fk_post_id);

        $count = $getPost->hits_count;

        $data['hits_count'] = $count+1;
        $getPost->update($data);

        $comment = ImageComment::findOrFail($commentData);
        //broadcast(new Comments($comment))->toOthers();
        return $comment;
      }

      public function imgCommentLike(Request $request)
    {
        $input = $request->all();
        $status = $input['status'];
        $commentId  = $input['fk_comment_id'];

        $checkCommentLike = ImgCommentLike::existsUserImgCommentLike($input);
        if($status==0 && count($checkCommentLike) == 0){
            ImgCommentLike::create($input);
             
        }else{
            if(count($checkCommentLike)>0){

                $checkCommentLike->delete(); 
                
            }
              
        }
        
        
        $getCommentLike = ImgCommentLike::getCommentIdWise($commentId);
        //broadcast(new PostLikes($getImage))->toOthers();
        return json_encode($getCommentLike);
        

    }   
}
