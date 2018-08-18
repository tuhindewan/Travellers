<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\Models\HostAccumulatorImage;
class HostAccumulatorImage extends Eloquent
{
    protected $collection = 'host_accumulator_image';
    protected $fillable = ['fk_accumulator_id','image'];

    public static function createAccumulatorImage($insertId, $image){
        
        return DB::collection('host_accumulator_image')
        ->insert([
            'fk_accumulator_id' => $insertId,
            'image' => $image,
            'created_at' => date('Y-m-d h:i:s')
            ]); 
    }
}
