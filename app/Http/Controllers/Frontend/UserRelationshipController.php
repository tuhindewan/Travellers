<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\Relationship;

class UserRelationshipController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','checkstatus']);
    }
    public function send_user_request(Request $request)
    {
    	$input  = $request->all();
    	$user_id = Auth::user()->_id;
    	$all_user = User::getAllUser($user_id);
    	$sender = $user_id;
    	try {

    	    $id = Relationship::request_send($input,$sender);
    	    $bug = 0;

    	} catch (\Exception $e) {

    	    $bug = $e->errorInfo[1];
    	    $bug1 = $e->errorInfo[2];
    	    
    	}

    	if($bug == 0){
    	    
    	    return view('frontend.profile_settings.all_search_list',compact('input','all_user'));
    	}
    	
    }

    public function removeFriend($friendId)
    {
       $myId = Auth::user()->_id;
       $checkOne = Relationship::getRelationshipMY($myId, $friendId);
       if(count($checkOne)>0){
            $checkOne->delete();
            return '1';
       }
       $checkTwo = Relationship::getRelationshipFriend($friendId, $myId);
       if(count($checkTwo)>0){
         $checkTwo->delete();
         return '1';
       }
       
    }

    public function accepterequest($id)
    {
        $user_id = Auth::user()->_id;

        $checkRequest = Relationship::where('user_id_one',$id)
                           ->where('user_id_two',$user_id)
                           ->first();

        if ($checkRequest)
        {
            $conreq = Relationship::updatestatus($id, $user_id);
            return "yes";
        }
        else
        {
            return "no";
        }                    
    }

    public function friends($id)
    {
        //return $id;
        $friendsOne = Relationship::getFriendOne($id);
        $friendsTwo = Relationship::getFriendTwo($id);
        $userInfo = '';
        foreach ($friendsOne as $friend) {
            
            $userId= User::findOrFail($friend->user_id_two);
            

            if(count($userId)>0){
                $userInfo[] = $userId;    
            }
               
            
        }
       foreach($friendsTwo as $friend){
            
            $userId= User::findOrFail($friend->user_id_one);
            

            if(count($userId)>0){
                $userInfo[] = $userId;
            }
        }

        
        $userInfo1 = '';



        if(count($userInfo)>0 && $userInfo !=""){
            foreach ($userInfo as $user) {
                if($user->activity==1){
                    $userInfo1[] = $user;
                }
            }
            foreach ($userInfo as $user) {
                if($user->activity==0){
                    $userInfo1[] = $user;
                }
            }
        }

        return json_encode($userInfo1);
        
   
    
    }


}
