<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\Models\AccumulatorRooms;
class AccumulatorRooms extends Eloquent
{

    protected $collection = 'accumulator_room';
    protected $fillable = ['fk_accumulator_id','room_type','room_description','adult','children','rent_rate','currency'];

    public static function createRoom($id, $data){
    	 
		return DB::collection('accumulator_room')
    	->insertGetId([
    		'fk_accumulator_id' => $id,
    		'room_type' => $data['room_type'],
    		'room_description' => $data['room_description'],
    		'adult' => $data['adult'],
    		'children' => $data['children'],
    		'rent_rate' => $data['rent_rate'],
    		'currency' => $data['currency'],
    		'created_at' => date('Y-m-d h:i:s')
    		]);
    }

    public function accumulator_room_image(){
        return $this->hasMany('App\Models\AccumulatorRoomImage','fk_room_id');
    }
}
