<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\UserProfileImage;
use App\Models\UserCoverImage;
use App\Models\UserVerifi;
use App\Mail\UserVerifiMail;
use App\Models\CurrentCity;
use App\Models\CountryPlace;
use App\Models\PersonalInformation;
use App\Models\Relationship;
use App\Models\Posts;
use App\Models\PostImages;
use App\Models\UserFeaturedPhoto;
use Auth;
use Validator;
use Response;
use DB;
use Hash;
use URL;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','checkstatus']);
    }
    public function index($username){
        
        $input=array('name'=>$username);
        $validator = \Validator::make($input,[
            'name' => 'exists:users,username',
        ]);
        if($validator->fails()){
            return "404";
        }
        $user_info = User::where('username',$username)->first();
        $getFeaturedPhoto = UserFeaturedPhoto::where('fk_user_id',$user_info->_id)->get();
        $authId = Auth::user()->_id;
        $getUser = User::findOrFail($authId);
        $chechRelation = $this->checkRelation($user_info->_id);

        return view('frontend.user.index',compact('user_info','getCover','getUser','chechRelation','getFeaturedPhoto'));    
    }
    

    public function checkRelation($UserId)
    {
        $authId = Auth::user()->_id;
        $check = Relationship::getRelationshipMY($authId, $UserId);
        if($authId == $UserId){
            $chechRelation = '';
        }else{
            if(count($check)>0){
                $result = "pending";
            }else{
                $check = Relationship::getRelationshipFriend($UserId, $authId);
                if($check !=""){
                    $result = "accept"; 
                }else{
                    $result = '';
                }   
            }
            if($check==''){     
                $chechRelation = 'Add To Friend';
            }elseif($check['status']==0){
                if($check !='' && $result=="accept"){
                    $chechRelation = 'Accept Friend Request';
                     }else{
                      $chechRelation = 'Pending Request';
                  }
            }else{
                $chechRelation = 'Friend';
            }
        }
        return $chechRelation;
    }

    public function spa(){
        $id = Auth::user()->_id;
        $getUser = User::findOrFail($id);
        return view('frontend.test.index',compact('getUser'));
    }

    public function about(){
    	$id = Auth::user()->_id;
    	$getUser = User::findOrFail($id);
    	$getInfo = PersonalInformation::getInformationById($id);
    	return view('frontend.user.user_about', compact('getUser','getInfo'));
    }

    public function userAllPhotos()
    {
        $logged_id = Auth::user()->_id;
        $user_info = User::findOrFail($logged_id);
        $images = PostImages::getImageByUserId($logged_id);
         /*$id = $images[0]->fk_post_id;
         $post = Posts::where('_id',$id)->first();
         echo $post->description;exit;*/
        return view('frontend.user.user_photos',compact('images','user_info'));
    }
    public function userPostPhotos($id)
    {
        $getPosts = Posts::getUserWisePost($id);
        $images=array();
        foreach ($getPosts as $post) {
            foreach ($post->post_image as $postImage) {
                   $images[] = $postImage;
               }   
        }
        
        return json_encode($images); 
    }
    public function allfriend()
    {
        $id = Auth::user()->_id;
        //friendsOne means "i sent request to other user to become friends"
        /*$requesters = Relationship::getAllFriendRequest($id);
        return $requesters[0];*/


        /*$friendsOne = Relationship::getFriendOne($id);*/

        $friendsOne = Relationship::getFriendOne($id);

        //friendsTwo means "i received request from other users"            

        $friendsTwo = Relationship::getFriendTwo($id);
        return view('frontend.user.user_friends',compact('friendsOne','friendsTwo'));


        

        $friends = array_merge($friendsOne->toArray(), $friendsTwo->toArray()); 

        return $friends[0]->users2;

         


            
    }

    public function getUserProfileInfo(){
    	$id = Auth::user()->_id;
    	$getUser = User::findOrFail($id);
    	$getInfo = PersonalInformation::getInformationById($id);
    	return view('frontend.user.edit_profile', compact('getUser','getInfo'));
    }

    public function gotoUserProfile($u_id)
    {
        $getUser = User::findOrFail(Auth::user()->_id);
        $user_info = User::findOrFail($u_id);
        $getCover = UserCoverImage::getCoverImageById($u_id);
        return view('frontend.user.view_profile',compact('user_info','getCover','getUser'));
    }

    public function userFriends($search=null,$userId=null)
    {
        if($userId==null){

            $id = Auth::user()->_id;
        }else{
            $id = $userId;
        }
        $friendsOne = Relationship::getFriendOne($id);
        $friendsTwo = Relationship::getFriendTwo($id);
        $userInfo = '';
        foreach ($friendsOne as $friend) {
            if($search==null){
                $userId= User::findOrFail($friend->user_id_two);
            }elseif($search==""){
                $userId= User::findOrFail($friend->user_id_two);   
            }else{
                $userId= User::searchFriend($friend->user_id_two,$search);    
            }

            if(count($userId)>0){
                $userImage= URL::to('/images/users/profile/s160').$userId['profile_image'];
                $obj = new User();
                $obj->id = $userId->_id;
                $obj->name = $userId->fullname;
                $obj->image = $userImage;
                $obj->activity = $userId->activity;
                $userInfo[] = $obj;    
            }
               
            
        }
       foreach($friendsTwo as $friend){
            if($search==null){
                $userId= User::findOrFail($friend->user_id_one);
            }else{
                $userId= User::searchFriend($friend->user_id_one,$search);
            }

            if(count($userId)>0){
                $userImage= URL::to('/images/users/profile/s160').$userId['profile_image'];
                $obj = new User();
                $obj->id = $userId->_id;
                $obj->name = $userId->fullname;
                $obj->image = $userImage;
                $obj->activity = $userId->activity;
                $userInfo[] = $obj;
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

    public function userOnline($id){
        $userInfo = User::findOrFail($id);
        //return $userInfo->activity;
        
        User::where('_id', $userInfo->id)->update([
            'activity' => 1
        ]);
        

        return 'online';
    }

    public function userOffline($id){
        $userInfo = User::findOrFail($id);
        
        User::where('_id', $userInfo->id)->update([
            'activity' => 0
        ]);
        

        return 'offline';
    }

    public function searchFriend(Request $request){
        $input = $request->all();
        $data = $input['friendSearch'];
        $result = $this->userFriends($data);
        return $result;
    }

    public function authInfo(){
        $id = Auth::user()->_id;
        $authinfo = User::findOrFail($id);
        return json_encode($authinfo);
    }

    public function friendsPost($number=null)
    {
        $result = $this->userFriends();
        $getUser = json_decode($result);
        //return $getUser;
        if($number !==null){
            $getPost = Posts::orderBy('created_at','desc')->limit(intval($number))->get();
        }else{
            $getPost = Posts::orderBy('created_at','desc')->get();
        }
        $posts = array();
        foreach ($getPost as $post) {
            if(Auth::user()->_id == $post->fk_user_id){
               $posts[] = $post;
            }
            if(!empty($getUser)){
                foreach ($getUser as $row) {
                    if($row->id == $post->fk_user_id ){
                            
                        $posts[] = $post;
                    }   
                }
            }
          
        }
        
        return $posts;   
    }

    public function publicPost($number=null)
    {
        
        if($number !==null){
            $getPost = Posts::where('posted_by',2)->orderBy('created_at','desc')->limit(intval($number))->get();
        }else{
            $getPost = Posts::where('posted_by',2)->orderBy('created_at','desc')->get();
        }
        
        return json_encode($getPost);   
    }
    public function friendMarker($type)
    {
        $result = $this->userFriends();
        $getUser = json_decode($result);
        //return $getUser;
        $id = Auth::user()->_id;
        $getPlaceId=array();
        $getPlaceId = Posts::getUserWisePostPlaceId($id, $type);
        if(!empty($getUser)){
            foreach ($getUser as $user) {
               $getPost = Posts::getUserWisePostPlaceId($user->id, $type);
               if(count($getPost)>0){
                foreach ($getPost as $post) {
                    $getPlaceId[] = $post; 
                }

               }
            }
        }

        

        
        //$placeId = array_filter($getPost, function($var){return !is_null($var);} );
        $markers=array();
        if(count($getPlaceId) > 0){

            foreach ($getPlaceId as $placeId) {
                
                $getPlace = CountryPlace::findOrFail($placeId);
                $place = new CountryPlace();
                $place->id = $getPlace->_id;
                $place->position = new CountryPlace();
                $place->position->lat = doubleval($getPlace->lat);
                $place->position->lng = doubleval($getPlace->lon);
                $place->infoText=$getPlace->place_name;
                $markers[] = $place;   
                
                
            }
        }
        return $markers;
          
    }


    public function userfriend($id)
    {
        $search = null;
        $result = $this->userFriends($search, $id);
        return $result;  
    }

    public function userMarker($id,$place)
    {
        $getPlaceId = Posts::getUserWisePostPlaceId($id,$place);
        //return $getPlaceId;
        $markers = array();
        if(count($getPlaceId) > 0){

            foreach ($getPlaceId as $placeId) {
                $getPlace = CountryPlace::findOrFail($placeId);
                $place = new CountryPlace();
                $place->id = $getPlace->_id;
                $place->position = new CountryPlace();
                $place->position->lat = doubleval($getPlace->lat);
                $place->position->lng = doubleval($getPlace->lon);
                $place->infoText=$getPlace->place_name;
                $markers[] = $place;
            }
        }
        return $markers;
    }





}
