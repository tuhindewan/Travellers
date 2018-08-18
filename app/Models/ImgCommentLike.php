<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\Models\ImgCommentLike;
class ImgCommentLike extends Eloquent
{
	public $with =['users'];
    protected $collection = 'image_comment_like';
    protected $fillable = ['fk_comment_id','fk_user_id','liked_by'];

    public function image_comment(){
        return $this->belongsTo('App\Models\ImageComment','fk_comment_id');
    }

    public function users(){
        return $this->belongsTo('App\User','fk_user_id');
    }

    public static function existsUserImgCommentLike($input){
        
        return ImgCommentLike::where('fk_comment_id', $input['fk_comment_id'])
        ->where('fk_user_id', $input['fk_user_id']) 
        ->first(); 
    }

    public static function getCommentIdWise($commentId){
        
        return ImgCommentLike::where('fk_comment_id', $commentId)->get(); 
    }
}
