<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Traits\FriendableTrait;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use DB;
use App\User;
class User extends Eloquent  implements Authenticatable
{
    use AuthenticableTrait;
    use FriendableTrait;
    use Notifiable;
    public $with = ['current_city'];
    protected $collection = 'users';
    protected $fillable = ['username', 'email', 'password','phone','country_code','gender','firstname','middlename','lastname','fullname','month','day','year','verification','verifiedstatus','status','fk_city_id','profile_image','cover_image','address','interests','prefers','intos','inspiration'];

    public static function userSignUp($input){
        return DB::collection('users')
        ->insertGetId([
            'username'       => $input['username'],
            'email'          => $input['email'],
            'password'       => $input['password'],
            'phone'          => $input['phone'],
            'country_code'   => $input['country_code'],
            'gender'         => $input['gender'],
            'firstname'      => $input['firstname'],
            'middlename'     => $input['middlename'],
            'lastname'       => $input['lastname'],
            'fullname'       => $input['firstname'].' '.$input['middlename'].' '.$input['lastname'],
            'month'          => $input['month'],
            'day'            => $input['day'],
            'year'           => $input['year'],
            'verification'   => 0,//user verified or unverified
            'verifiedstatus' => 0,//user check email
            'status'         => 1,//active or inactive
            'fk_city_id'     => $input['fk_city_id'],
            'profile_image'  => $input['profile_image'],
            'cover_image'    => '',
            'created_at'     => date('Y-m-d h:i:s')
            ]);
    }

    public static function insertCoverId($imageId,$user_id)
    {
        return DB::collection('users')
        ->where('_id', $user_id)  // find your user verifi by their id
        ->update([
            'fk_cover_id' => $imageId
            ]);
    }

    public static function userUpdateVerifiedStatus($id){
        return DB::collection('users')
        ->where('_id', $id)  // find your user verifi by their id
        ->update([
            'verifiedstatus' => 1
            ]);
    }

    
    public function posts(){
        return User::hasMany('App\Models\Posts','fk_user_id');
    }

    public function user_room_booking(){
        return User::belongsTo('App\Models\UserRoomBooking','fk_user_id');
    }

    // public function images(){
    //     return $this->belongsTo('App\Models\UserProfileImage','fk_user_id');
    // }
    // public function user_image() {
    //     return User::belongsTo('App\Models\UserProfileImage','fk_image_id');
    // }

    public function reports(){
        return User::hasMany('App\Models\Reports','fk_user_id');
    }
    
    public  function user_cover() {
        return User::belongsTo('App\Models\UserCoverImage','fk_cover_id');
    }
    

    public static function getUserBasicInfo() {
        return DB::collection('users')
        ->select('username','email','phone','status','fk_city_id','firstname','middlename','lastname','profile_image','fullname')
        ->get();
    }

    public  function infomations()
    {
        return User::hasOne('App\Models\PersonalInformation','fk_user_id');
    }


    public  function relationships()
    {
        return User::hasOne('App\Models\Relationship','user_id_one');
    }


    public  function friends()
    {
        return User::hasOne('App\Models\Relationship','user_id_two');
    }

    // public static function friends()
    // {
    //     return User::hasOne('App\Models\Relationship','user_id_two');
    // }

    public  function notifications1()
    {
        return User::hasOne('App\Models\Notification','user_logged');
    }

    public  function notifications2()
    {
        return User::hasOne('App\Models\Notification','sender');
    }

    

    public function current_city() {
        return User::belongsTo('App\Models\CurrentCity','fk_city_id');
    }
    


    public static function getUserById($userId){
        return  DB::collection('users')->where('_id', new \MongoDB\BSON\ObjectID($userId))->first();
    }

    public static function getAllUser($user_id)
    {
        return  User::where('_id','!=', new \MongoDB\BSON\ObjectID($user_id))->get();
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function receivers() {
        return $this->hasMany('App\Receiver');
    }

    //search friend user information
    public static function searchFriend($id,$search){
        //echo ($search);exit;
        return User::where('_id',$id)
        ->where('fullname','like','%'.$search.'%')
        ->first();
    }

    public static function checkSearchUser($search)
    {
        return User::where('fullname', 'LIKE', '%'. $search .'%')
        ->orderBy('id','desc')
        ->get();
    }


}
