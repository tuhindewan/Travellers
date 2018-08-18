<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\Models\UserVerifi;
class UserVerifi extends Eloquent
{
    protected $collection = 'user_verifi';
    protected $fillable = ['fk_user_id', 'code','end_time'];

    
    public static function userVerification($userId, $code, $endTime){
    	
		return DB::collection('user_verifi')
    	->insert([
    		'fk_user_id' => $userId,
    		'code' => $code,
    		'end_time' => $endTime,
    		'created_at' => date('Y-m-d h:i:s')
    		]);	
    }

    public static function getUserVerifiInfoInUserId($id){
       return UserVerifi::where('fk_user_id', new \MongoDB\BSON\ObjectID($id))->first();
       
    }

    public static function userVerificationCodeUpdate($id,$code,$endTime){
        return DB::collection('user_verifi')
        ->where('_id', $id)  // find your user verifi by their id
        ->update([
            'code' => $code,
            'end_time' => $endTime
            ]);
       
    }

    public static function userWiseVerifiDelete($id){
        return DB::collection('user_verifi')
        ->where('_id', $id)  // find your user verifi by their id
        ->delete();
       
    }
}
