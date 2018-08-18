<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\Models\HostAccumulator;
class HostAccumulator extends Eloquent
{
    protected $collection = 'host_accumulator';
    protected $fillable = ['fk_host_id', 'title', 'description','location','facility','room_no','place_name','lat','lon','status','terms_condition'];

    public function accumulator_image(){
        return $this->hasMany('App\Models\HostAccumulatorImage','fk_accumulator_id');
    }

    public function accumulator_room(){
        return $this->hasMany('App\Models\AccumulatorRooms','fk_accumulator_id');
    }

    public static function searchLocationWiseAccumulator($input){
        return HostAccumulator::where('location', $input['location'])
        ->where('room_no','>=', $input['room'])
        ->get();
    }
    public static function searchLocationEmptyWiseAccumulator($input){
    	return HostAccumulator::where('room_no','>=', $input['room'])
    	->get();
    }
}
