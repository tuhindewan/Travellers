<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\Relationship;
use App\Models\Posts;
use App\Models\UserProfileImage;


class AllSearchListController extends Controller
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

    /*public function AllSearchListPeople()
    {

        $user_id = Auth::user()->_id;
        $getUser = User::findOrFail($user_id);
        $all_user = User::getAllUser($user_id);

        return view('frontend.profile_settings.all_search_list',compact('all_user','getUser'));
    }*/

    public function sendRequest($id)
    {
         Auth::user()->addFriend($id);

         return back();

    }

    /*public static function send_user_request(Request $request)
    {
        $input  = $request->all();
        $user_id = Auth::user()->_id;
        $all_user = User::getAllUser($user_id);
        $sender = $user_id;
        try {

            $id = Relationship::request_send($input,$sender);
            $bug = 0;

        } catch (Exception $e) {

            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
            
        }

        if($bug == 0){
            $getdata = Relationship::all();
            return view('frontend.profile_settings.all_search_list',compact('getdata','all_user'));
        }
        
    }*/

    
    public function search(Request $request)
    {
        $input = $request->all();
        if($input['search'] != null){
            if($input['type']==0){
                return url('/').'/search/'.$input['search'];
            }
            return redirect('search/'.$input['search']);
        }else{
            return redirect()->back();
        }
    }

    public function searchResult($search)
    {
        $getPosts = Posts::checkSearchPost($search);

        $getUser = User::checkSearchUser($search);
        //return $getUser;
        return view('frontend.profile_settings.all_search_list',compact('getPosts','getUser','search'));
    }
    

}
