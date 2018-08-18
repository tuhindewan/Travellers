<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\Models\AccumulatorRoomImage;
use App\Models\AccumulatorRooms;
class AccumulatorRoomImage extends Eloquent
{
    protected $collection = 'accumulator_room_image';
    protected $fillable = ['fk_room_id','image'];

    public static function createAccumulatorRoomImage($insertId, $image){
        
        return DB::collection('accumulator_room_image')
        ->insert([
            'fk_room_id' => $insertId,
            'image' => $image,
            'created_at' => date('Y-m-d h:i:s')
            ]); 
    }

    // public function accumulator_room(){
    //     return $this->belongsTo(AccumulatorRooms::class);
    // }
}
