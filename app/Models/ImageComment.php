<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
//use App\Models\ImageComment;
class ImageComment extends Eloquent
{
	public $with = ['users','image_comment_like'];
    protected $collection = 'image_comment';
    protected $fillable = ['fk_image_id','fk_user_id','comment','comment_by'];

    public function post_image(){
        return $this->belongsTo('App\Models\PostImages','fk_image_id');
    }

    public function users(){
        return $this->belongsTo('App\User','fk_user_id');
    }

    public function image_comment_like(){
        return $this->hasMany('App\Models\ImgCommentLike','fk_comment_id');
    }
}
