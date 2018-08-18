<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use Auth;
class BookingAccumulator extends Eloquent
{
    public $with = ['users','host_accumulator','accumulator_room'];
    protected $collection = 'booking_accumulator';
    protected $fillable = ['fk_user_id','fk_accumulator_id','fk_room_id','check_in','check_out','re_confirm','status','is_unread'];

    public static function checkExistRequest($id)
    {
    	$authId = Auth::user()->_id;
    	return DB::collection('booking_accumulator')
    	->where('fk_user_id',$authId)
    	->where('fk_accumulator_id', $id)
    	->first();
    }

    public function users() {

        return $this->belongsTo('App\User','fk_user_id');
    }

    public function host_accumulator() {

        return $this->belongsTo('App\Models\HostAccumulator','fk_accumulator_id');
    }
    public function accumulator_room() {

        return $this->belongsTo('App\Models\AccumulatorRooms','fk_room_id');
    }

    public static function checkInRoomAvailable($accumulatorId, $roomId, $checkIn, $checkOut)
    {
        return DB::collection('booking_accumulator')
        ->where('fk_accumulator_id', $accumulatorId)
        ->where('fk_room_id',$roomId)
         ->where('check_in','<=',$checkIn)
         ->where('check_out','>=',$checkIn)
        ->where('status',1)
        ->get();
    }

    public static function checkOutRoomAvailable($accumulatorId, $roomId, $checkIn, $checkOut)
    {
        return DB::collection('booking_accumulator')
        ->where('fk_accumulator_id', $accumulatorId)
        ->where('fk_room_id',$roomId)
        ->where('check_in','<=',$checkOut)
        ->where('check_out','>=',$checkOut)
        ->where('status',1)
        ->get();
    }

    
}
