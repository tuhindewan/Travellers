<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CurrentCity;
use App\Models\CountryPlace;
use App\User;
use App\Models\UserProfileImage;

use App\Models\Posts;
use App\Models\PostLike;
use App\Models\PostComment;
use App\Models\PostSubComment;
use App\Models\PostImages;
use Auth;
use DB;
class HomePageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','checkstatus']);
    }
    public function index(){
        $id = Auth::user()->_id;
        $getUser = User::findOrFail($id);
        //$userProfile = UserProfileImage::singleUserWiseProfile($id);
        //$getPostWisePlaceId = Posts::getPostWisePlaceId(); 
    	//$getPlace = CountryPlace::all(); 
        //$getPlacewisePost = Posts::with('places')->get();
        //$getPlacewisePost = Posts::with('users')->get();
        //return $getPost;
    	return view('frontend.newsfeed.welcome', compact('getUser'));
    }

    public function checkPlace($latitude,$longitude){
    	$input = [
    		'lat' => $latitude,
    		'lon' => $longitude
    	];
        //return $input['lat'];
    	$getPlace = CountryPlace::checkExistPlace($input);
        return $getPlace;
    	if(count($getPlace)>0){

    		return redirect('place/'.$getPlace['_id']);
    	}else{
    		return "you are not access";
    	}

    	
    }

    public function placeWisePostShow($placeId){
        
    	$getSinglePlace = CountryPlace::findOrFail($placeId);
    	//return $getSinglePlace['lat'];
        $getPostWisePlaceId = Posts::getPostWisePlaceId(); 
        $getPlace = CountryPlace::all();
        $getUserInfo = User::getUserBasicInfo();
        $getPosts = Posts::getPlaceWisePost($placeId);
        $getPostWiseImage = PostImages::all();
        $myId = \Auth::user()->_id;
        $getUser = User::findOrFail($myId);
        $getPostLike = PostLike::checkMyLikeOnPost($myId);
        $getPostComment = PostComment::orderBy('_id','desc')->get();
        $getSubComment = PostSubComment::orderBy('_id','asc')->get();
        $myProfile = UserProfileImage::singleUserWiseProfile($myId);
        $getUserName = User::select('_id','username')->get();
        
    	return view('frontend.show-page',compact('getSinglePlace','getPlace','getPostWisePlaceId','getPosts','getUserInfo','getPostWiseImage','getPostLike','getPostComment','myProfile','getUserName','getSubComment','getUser','placeId'));
    }

    public function placeWisePost($placeId){
        $getPosts = Posts::getPlaceWisePost($placeId);
        
        return json_encode($getPosts);   
    }

    public function publicMarker($place)
    {
        $getPlaceId = Posts::getPublicPostWisePlaceid($place);
        $markers = array();
        //return $getPlaceId;
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
    

    public function placeMarker($place)
    {
        
        $getPlace = CountryPlace::findOrFail($place);
        $place = new CountryPlace();
        $place->id = $getPlace->_id;
        $place->position = new CountryPlace();
        $place->position->lat = doubleval($getPlace->lat);
        $place->position->lng = doubleval($getPlace->lon);
        $place->infoText=$getPlace->place_name;
        
            
        return $place;
    }

    public function friendMap()
    {
        $id = Auth::user()->_id;
        
        $getUser = User::findOrFail($id);
        
        return view('frontend.map.index', compact('getUser'));
    }
}
