<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\Models\CountryPlace;
class CountryPlace extends Eloquent
{
    protected $collection = 'place';
    protected $fillable = ['place_name','lat','lon','status'];
    public function posts() {

        return CountryPlace::hasMany('App\Models\Posts','fk_place_id');
    }
    public function agencies_post() {

        return CountryPlace::hasMany('App\Models\AgenciesPost','fk_place_id');
    }

    public static function checkExistPlace($input){
    	
		return DB::collection('place')
		->where('lat',$input['lat'])
		->where('lon',$input['lon'])
		->first();


    }

    public static function createCountryPlace($input){
    	 
		return DB::collection('place')
    	->insertGetId([
    		'place_name' => $input['place'],
    		'lat' => $input['lat'],
    		'lon' => $input['lon'],
    		'status' => 1,
    		'created_at' => date('Y-m-d h:i:s')
    		]);
    }
}
