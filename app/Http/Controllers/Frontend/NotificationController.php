<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\User;
use App\Models\Relationship;
use App\Models\Notification;
use App\Models\UserCoverImage;
use App\Models\BookingNotification;
use App\Models\BookingAccumulator;
use App\Models\AccumulatorRoomImage;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','checkstatus']);
    }
    public function index()
    {
        $logged = Auth::user()->_id;
        $friendnotis = Notification::getFriendNoti($logged);
        return view('frontend.profile_settings.notifications',compact('friendnotis'));
    }

    public function userProfile($s_id,$n_id)
    {
        $logged = Auth::user()->_id;
        DB::collection('notifications')
                    ->where('_id',$n_id)
                    ->where('user_logged', $logged)
                    ->update(['status' => 0]);

        $user_info = User::findOrFail($s_id);
        //$getCover = UserCoverImage::getCoverImageById($s_id);
        return redirect("/$user_info->username");
        return view('frontend.user.view_profile',compact('user_info','getCover'));
    }

    public function userAllActivity()
    {
        $logged = Auth::user()->_id;
        $notis = Notification::getUserNotification($logged);
        return view('frontend.profile_settings.activities',compact('notis'));
    }

    //booking notification
    public function booking()
    {
        $authId = Auth::user()->_id;
        $getNotification = BookingNotification::userWiseNotification($authId);
        $getRoomImg = AccumulatorRoomImage::get();
        
        $getNotify = array();
        foreach ($getNotification as $notification) {
            $getbooking = BookingAccumulator::where('_id',$notification['thread_id'])->first();
            
            if(count($getbooking) > 0){


                $notify = new BookingNotification();
                $img = '';
                foreach ($getRoomImg as $roomImg) {
                    if($roomImg->fk_room_id == $getbooking->fk_room_id){
                        $img = url('/images/host/room/photo/thum').'/'.$roomImg->image;
                        break;
                    }
                }
                $notify->rImg = $img;
                $notify->_id = $notification['_id'];
                $notify->thread_id = $notification['thread_id'];
                $notify->thread_type = $notification['thread_type'];
                $notify->body_text = $notification['body_text'];
                $notify->is_unread = $notification['is_unread'];
                $notify->time = $notification->created_at->diffForHumans();
               $getNotify[] = $notify;
            }      
        }
        return $getNotify;
        
        //return json_encode($getNotification);
    }

    public function isReadBN($id)
    {
        $getNotification = BookingNotification::findOrFail($id);
        $status = [
            'is_unread' => 1
        ];

        $getNotification->update($status);
        return "success";
    }
}
