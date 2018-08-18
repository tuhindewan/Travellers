<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;

class Notification extends Eloquent
{
    public function loggeduser()
    {
        return Notification::belongsTo('App\User','user_logged');
    }

    public function senderuser()
    {
        return Notification::belongsTo('App\User','sender');
    }

    public static function getFriendNoti($logged)
    {
    	DB::collection('notifications')
    	            ->where('user_logged', $logged)
    	            ->update(['status' => 0]); 

		return Notification::where('user_logged',$logged)
	            ->where('type',1)
	            ->orderBy('created_at','desc')
	            ->get();
    }

    public static function getUserNotification($logged)
    {
        return Notification::where('user_logged',$logged)
                ->orderBy('created_at','desc')
                ->get();
    }
}
