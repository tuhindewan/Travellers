<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\Models\BookingNotification;
class BookingNotification extends Eloquent
{
	public $with = ['users','booking_accumulator'];

    protected $collection = 'booking_notification';
    protected $fillable = ['fk_user_id', 'thread_id', 'thread_type','body_text','is_unread'];

    public static function userWiseNotification($id)
    {
    	return BookingNotification::where('fk_user_id', $id)
    	->orderBy('_id','desc')
    	->get();
    }

    public function users() {

        return $this->belongsTo('App\User','fk_user_id');
    }

    public function booking_accumulator() {

        return $this->belongsTo('App\Models\BookingAccumulator','thread_id');
    }

    // public function posts(){
    //     return $this->belongsTo('App\Models\Posts','thread_id');
    // }
}
