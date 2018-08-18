<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;

class HostDestination extends Eloquent
{
    protected $collection = 'host_info_place';
    protected $fillable = ['place_name','lat','lon','fk_host_info_id'];

    public static function createHostDestination($input,$hostInfoId)
    {
    			return DB::collection('host_info_place')
    	    	->insertGetId([
    	    		'place_name' => $input['destination'],
    	    		'lat' => $input['lat'],
    	    		'lon' => $input['lon'],
    	    		'fk_host_info_id' => $hostInfoId,
    	    		'created_at' => date('Y-m-d h:i:s')
    	    		]);
    }

    public static function findDestinationById($id)
    {
        return DB::collection('host_info_place')
                ->where('fk_host_info_id',new \MongoDB\BSON\ObjectID($id))
                ->first();
    }

    
}
