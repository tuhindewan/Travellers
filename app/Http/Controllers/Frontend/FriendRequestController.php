<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\Relationship;
use App\Models\UserProfileImage;


class FriendRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','checkstatus']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function allRequests()
    {
        $user_id = Auth::user()->_id;

        $requesters = Relationship::getAllFriendRequest($user_id);
        /*return $requesters[0]->users;*/
        /*foreach ($requesters as $value) {
            return $value->users->user_image;
        }*/
        return view('frontend.profile_settings.friend_request',compact('requesters'));
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
            return back();
        }
        else
        {
            echo "wrong";
        }                    
    }

    public function removeFriend($id)
    {
        $loggedUser = Auth::user()->_id;
        Relationship::where('user_id_one',$loggedUser)->where('user_id_two',$id)->delete();
        return back();
    }

    public function removeFriend2($id)
    {
        $loggedUser = Auth::user()->_id;
        Relationship::where('user_id_one',$id)->where('user_id_two',$loggedUser)->delete();
        return back();
    }

    public function sendRequest($id)
    {   
        $sender = Auth::user()->_id;
        $input['user_id_two'] = $id;
        $input['status'] = 0;

        try {
           $created = Relationship::request_send($input,$sender);
           return 'yes';
        } catch (\Exception $e) {
           return 'no'; 
        }

    }

    

}
