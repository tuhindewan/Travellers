<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\Models\Posts;

class Posts extends Eloquent
{

    public $with = ['post_image','users','post_like','post_comment'];
    
    protected $collection = 'post';
    protected $fillable = ['post_type', 'posted_by', 'fk_user_id','fk_place_id','description','location','hits_count','like','comment','status'];

    public static function createPost($input){
        
        return DB::collection('post')
        ->insertGetId([
            'post_type' => $input['post_type'],
            'fk_user_id' => $input['fk_user_id'],
            'fk_place_id' => $input['fk_place_id'],
            'description' => $input['description'],
            'posted_by' => $input['posted_by'],
            'location' => "",
            'hits_count' => 0,
            'status' => 1,
            'created_at' => date('Y-m-d h:i:s')
            ]); 
    }


    public function users() {

        return Posts::belongsTo('App\User','fk_user_id');
    }
    public function places() {

        return Posts::belongsTo('App\Models\CountryPlace','fk_place_id');
    }

    public function post_image(){
        return Posts::hasMany('App\Models\PostImages','fk_post_id');
    }

    public function post_like(){
        return Posts::hasMany('App\Models\PostLike','fk_post_id');
    }

    public function post_comment(){
        return Posts::hasMany('App\Models\PostComment','fk_post_id');
    }
    
    public function reports(){
        return User::hasMany('App\Models\Reports','report_type_id');
    }

    public function feed_notification(){
        return Posts::hasMany('App\Models\FeedNotification','thread_id');
    }

    public static function getPostWisePlaceid() {

        return DB::table('post')
        ->distinct('fk_place_id')
        ->select('fk_place_id')
        ->get();
    }

    public static function getPublicPostWisePlaceid($id) {

        return DB::table('post')
        ->where('post_type',$id)
        ->distinct('fk_place_id')
        ->select('fk_place_id')
        ->get();
    }

    public static function getUserWisePostPlaceId($id,$place) {

        return DB::table('post')
        ->where('fk_user_id',$id)
        ->where('post_type',$place)
        ->distinct('fk_place_id')
        ->select('fk_place_id')
        ->get();
    }
    public static function getUserWisePlaceid($id) {

        return DB::table('post')
        ->where('fk_user_id',$id)
        ->distinct('fk_place_id')
        ->select('fk_place_id')
        ->get();
    }

    public static function getPlaceWisePost($placeId) {

        return Posts::where('fk_place_id',new \MongoDB\BSON\ObjectID($placeId))
        ->orderBy('_id','desc')
        ->get();
    }

    public static function getUserWisePost($userId) {

        return Posts::where('fk_user_id',$userId)
        ->orderBy('_id','desc')
        ->get();
    }

    public static function getUserWiseTypePost($userId,$type) {

        return Posts::where('fk_user_id',$userId)
        ->where('post_type',$type)
        ->orderBy('_id','desc')
        ->get();
    }

    public static function getPostData($logged_id){
        return Posts::where('fk_user_id',$logged_id)
        ->orderBy('created_at','desc')
        ->get();
    }

    public static function getAllPost()
    {
        return Posts::orderBy('created_at','desc')->get();
    }

    //type and location wise get post
    public static function typeWisePost($type, $location){
        return Posts::where('fk_place_id',new \MongoDB\BSON\ObjectID($location))
        ->where('post_type',$type)
        ->orderBy('_id','desc')
        ->get();
    }
    //check search result wise get post
    public static function checkSearchPost($search)
    {
        return Posts::where('description', 'LIKE', '%'. $search .'%')
        ->orderBy('id','desc')
        ->get();
    }
    
}
