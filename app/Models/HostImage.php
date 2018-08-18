<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\Models\HostImage;

class HostImage extends Eloquent
{
    protected $collection = 'host_info_image';
    protected $fillable = ['fk_host_info_id', 'images'];

    // public function host_info(){
    //     return $this->belongsTo('App\Models\Host','fk_host_info_id');
    // }

    public static function insertHostImages($hostInfoId,$image){
        
        return DB::collection('host_info_image')
        ->insert([
            'fk_host_info_id' => $hostInfoId,
            'images' => $image,
            'created_at' => date('Y-m-d h:i:s')
            ]); 
    }

    public static function getHostInfoImageById($info_id){
        return DB::collection('host_info_image')
               ->where('fk_host_info_id',$info_id)
               ->orderBy('created_at','asc')->first();
    }

    public static function findImageById($id)
    {
        return DB::collection('host_info_image')
               ->where('fk_host_info_id',new \MongoDB\BSON\ObjectID($id))
               ->get();
    }
}
