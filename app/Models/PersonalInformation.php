<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;

class PersonalInformation extends Eloquent
{
    protected $collection = 'PersonalInformation';
    protected $fillable = ['inspiration', 'interest', 'prefer','youare','fk_user_id'];


    public static function create($input)
    {
    	return DB::collection('PersonalInformation')
	    	->insertGetId([
	    		'inspiration' => $input['inspiration'],
	    		'interest' => $input['interest'],
	    		'prefer' => $input['prefer'],
	    		'youare' => $input['youare'],
	    		'fk_user_id' => $input['fk_user_id'],
	    		'created_at' => date('Y-m-d h:i:s'),
	    		]);
    }

    public static function getInformationById($id)
    {
    	return DB::collection('PersonalInformation')
    	->where('fk_user_id',$id)
    	->first();
    }

    public static function updateInformation($input,$id)
    {
    	return DB::collection('PersonalInformation')
    	->where('fk_user_id',$id)
    	->update([
    		'inspiration' => $input['inspiration'],
    		'interest' => $input['interest'],
    		'prefer' => $input['prefer'],
    		'youare' => $input['youare'],
    		'created_at' => date('Y-m-d h:i:s'),
    	]);
    }

    public static function users()
    {
        return PersonalInformation::belongsTo('App\User','fk_user_id');
    }
}
