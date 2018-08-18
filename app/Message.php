<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Message;
class Message extends Eloquent
{
	protected $collection = 'messages';
	protected $fillable = ['user_id','message','file_path','file_name','type','seen'];

	// public static function createMessage($input){
	// 	return Message::create([
	// 		'message' =>$input['message'],
	//         'type'    =>$input['type'],
	//         'seen'    =>0
	// 	]);
	// }

    public function user() 
    {
    	return $this->belongsTo('App\User');
    }

    public function receivers() {
        return $this->hasMany('App\Receiver');
    }

    /*public static function senderIdWiseMessage(){
    	return Message::where('user_id',$senderId)
    }*/
}
