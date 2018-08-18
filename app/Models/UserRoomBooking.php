<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//use Illuminate\Database\Eloquent\Model;
use DB;
class UserRoomBooking extends Eloquent
{
    protected $collection = 'user_room_booking';
    protected $fillable = ['fk_user_id','user_request','user_cancel','host_reject','host_confirm','user_not_come'];

    public static function checkUserExistsin($id)
    {
    	return DB::collection('user_room_booking')
    	->where('fk_user_id',$id)
    	->first();
    }

    public static function requestRoomBooking($id)
    {
    	return DB::collection('user_room_booking')
    	->insert([
            'fk_user_id'    => $id,
            'user_request'  => 1,
            'user_cancel'   => 0,
            'host_reject'   => 0,
            'host_confirm'  => 0,
            'user_not_come' => 0,
            'created_at' => date('Y-m-d h:i:s')
            ]); 
    }

    public function users(){
        return $this->hasOne('App\User','fk_user_id');
    }

}
