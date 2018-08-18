<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\Models\Relationship;
use App\Models\Notification;
class Relationship extends Eloquent
{
    protected $collection = 'relationships';
    protected $fillable = ['user_id_one', 'user_id_two','status','user_action_id'];

    public static function request_send($input,$sender)
    {
    	return DB::collection('relationships')
	    	->insertGetId([
	    		'user_id_one' => $sender,
	    		'user_id_two' => $input['user_id_two'],
	    		'status' => $input['status'],
	    		'user_action_id' => $sender,
	    		'created_at' => date('Y-m-d h:i:s'),
	    		]);
    }

	public function users()
	{
	    return Relationship::belongsTo('App\User','user_id_one');
	}

	public function users2()
	{
		return Relationship::belongsTo('App\User','user_id_two');
	}

    public static function getAllFriendRequest($user_id)
    {
    	return Relationship::where('user_id_two','=',$user_id)->get();
    }


    public static function updatestatus($id, $user_id)
    {
        $addNoti = Notification::insert([
            'user_logged' => $id,
            'sender'  => $user_id,
            'status'     => 1, //unread notification
            'type'     => 1, //friendship notification
            'created_at'   => date('Y-m-d h:i:s')
            ]);

    	return DB::collection('relationships')
            ->where('user_id_one', $id)
            ->where('user_id_two', $user_id)
            ->update(['status' => 1]);

            
    }


    public static function getFriendOne($id)
    {
        return Relationship::where('user_id_one',$id)
                ->where('status',1)
                ->get();
    }

    public static function getFriendTwo($id)
    {
        return Relationship::where('user_id_two',$id)
                ->where('status',1)
                ->get();
    }

    public static function getFriendOneById($logged_id)
    {
        return Relationship::select('user_id_one')->where('user_id_two',$logged_id)
                ->where('status',1)
                ->get();
    }

    public static function getFriendTwoById($logged_id)
    {
        return Relationship::select('user_id_two')->where('user_id_one',$logged_id)
                ->where('status',1)
                ->get();
    }

    public static function getRelationshipMY($myId, $friendId){
        return Relationship::where('user_id_one',$myId)
        ->where('user_id_two', $friendId)
        ->first();
    }

    public static function getRelationshipFriend($friendId, $myId){
        return Relationship::where('user_id_one',$friendId)
        ->where('user_id_two', $myId)
        ->first();
    }
    

}
