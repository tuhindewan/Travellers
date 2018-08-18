<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;

class Announcement extends Eloquent
{
    protected $collection = 'announcement';
    protected $fillable = ['description','start_date_time','last_date_time','fk_admin_id','status'];

    public static function create($input)
    {
    	return DB::collection('announcement')
	    	->insertGetId([
	    		'description' => $input['description'],
	    		'start_date_time' => $input['start_date_time'],
	    		'last_date_time' => $input['last_date_time'],
	    		'fk_admin_id' => $input['admin_id'],
	    		'status' => $input['status'],
	    		'created_at' => date('Y-m-d h:i:s'),
	    		]);
    }

    public static function updateAnnouncement($input,$id)
    {
    	return DB::collection('announcement')
    	->where('_id',$id)
    	->update([
    		'description' => $input['description'],
    		'start_date_time' => $input['start_date_time'],
    		'last_date_time' => $input['last_date_time'],
    		'fk_admin_id' => $input['admin_id'],
    		'status' => $input['status'],
    		'created_at' => date('Y-m-d h:i:s'),
    	]);
    }

    public static function getAdminByPostId($id)
    {
        return DB::collection('announcement')
        ->select('fk_admin_id')
        ->where('_id',new \MongoDB\BSON\ObjectID($id))
        ->first();
    }
}
