<?php

namespace App\Traits;
use App\Models\Relationship;
use Auth;
trait FriendableTrait
{
	public static function test(){
		return "hi";
	}

	public static function addFriend($user_id){
		$friendship = Relationship::create([
			'user_id_one' => Auth::user()->_id,
			'user_id_two' => $user_id,
			'status' => 0,
			'user_action_id' => Auth::user()->_id,
			'created_at' => date('Y-m-d h:i:s'),
		]);

		if ($friendship) {
			return $friendship;
		}


		return 'failed';
	}
}