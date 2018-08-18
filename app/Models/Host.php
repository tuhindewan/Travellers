<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\Models\Host;

class Host extends Eloquent
{
    //public $with = ['host_info_image'];
    
    protected $collection = 'host_info';
    protected $fillable = ['fk_user_id', 'title','city', 'description','start_date_time','end_date_time','adult','children','rent','currency','p_type','p_facility','place_name','lat','lon','status','terms_condition'];

    
    public function host_info_image(){
        return $this->hasMany('App\Models\HostImage','fk_host_info_id');
    }

    public static function createHost($input){
        
        return DB::collection('host_info')
        ->insertGetId([
            'fk_user_id' => $input['fk_user_id'],
            'title' => $input['title'],
            'description' => $input['description'],
            'city' => $input['city'],
            'start_date_time' => $input['start_date_time'],
            'end_date_time' => $input['end_date_time'],
            'adult' => $input['adult'],
            'children' => $input['children'],
            'rent' => $input['rent'],
            'p_type' => $input['p_type'],
            'p_facility' => $input['p_facility'],
            'place_name' => $input['destination'],
            'lat' => $input['lat'],
            'lon' => $input['lon'],
            'status' => $input['status'],
            'currency' => $input['currency'],
            'terms_condition' => $input['terms_condition'],
            'created_at' => date('Y-m-d h:i:s')
            ]); 
    }

    public static function searchHostDestination($dest,$adult,$children,$checkIn,$checkOut,$rent)
    {
        return Host::where('place_name', 'LIKE', '%' . $dest . '%')
                ->orWhere('adult',$adult)
                ->orWhere('children',$children)
                ->orWhere('start_date_time',$checkIn)
                ->orWhere('end_date_time',$checkOut)
                ->orWhere('rent',$rent)
                ->select('_id')
                ->get();
    }



    public static function match($value)
    {
        return DB::collection('host_info')
            ->where('p_facility',$value)
            ->first();
    }

    
}
