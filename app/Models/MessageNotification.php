<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\Models\MessageNotification;
class MessageNotification extends Eloquent
{
  	protected $collection = 'message_notification';
    protected $fillable = ['sender_id','receiver_id','status','last_sender'];  

    public static function existsConversationSender($sender_id, $receiver_id){
    	return DB::collection('message_notification')
    	->where('sender_id',$sender_id)
    	->where('receiver_id',$receiver_id)
    	->first();
    }

    public static function existsConversationReceiver( $receiver_id,$sender_id){
    	return DB::collection('message_notification')
    	->where('sender_id',$receiver_id)
    	->where('receiver_id',$sender_id)
    	->first();
    }

    public static function insertChatConvertion($sender_id, $receiver_id){
         
        return DB::collection('message_notification')
        ->insert([
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'status' =>0,
            'last_sender' => $receiver_id,
            'created_at' => date('Y-m-d h:i:s')
            ]);

    }

    public static function updateChatConvertion($id,$sender_id){
    	 
		return DB::collection('message_notification')
        ->where('_id',$id)
    	->update([
            'status' =>0,
    		'last_sender' => $sender_id,
            'updated_at' => date('Y-m-d h:i:s')
    		]);

    }

    public static function getNotificationSenderCount($id){
        return MessageNotification::where('sender_id',$id)
        ->where('status',0)
        ->where('last_sender',$id)
        ->get()->toArray();
    }

    public static function getNotificationReceiverCount($id){
        return MessageNotification::where('receiver_id',$id)
        ->where('status',0)
        ->where('last_sender',$id)
        ->get()->toArray();
    }

    public static function getNotificationSender($id){
    	return MessageNotification::where('sender_id',$id)
        ->orderBy('updated_at','desc')
    	->get()->toArray();
    }

    public static function getNotificationReceiver($id){
    	return MessageNotification::where('receiver_id',$id)
        ->orderBy('updated_at','desc')
    	->get()->toArray();
    }
    // public function sender() 
    // {
    // 	return $this->belongsTo('App\Message','user_id');
    // }
}
