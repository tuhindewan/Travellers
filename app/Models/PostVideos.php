<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;

class PostVideos extends Eloquent
{
    protected $collection = 'post_video';
    protected $fillable = ['fk_post_id', 'video','status'];

    public static function insertPostVideos($postId,$videoLink){
        
        return DB::collection('post_video')
        ->insert([
            'fk_post_id' => $postId,
            'video' => $videoLink,
            'status' => 0,
            'created_at' => date('Y-m-d h:i:s')
            ]); 
    }
}
