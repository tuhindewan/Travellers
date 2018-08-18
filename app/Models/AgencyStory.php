<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class AgencyStory extends Eloquent
{
    protected $collection = 'agencies_story';
    protected $fillable = ['fk_agency_id','story_title','story_image','story_details'];

    public static function checkExistAgencyStory($id)
    {
    	return DB::collection('agencies_story')
    	->where('fk_agency_id',$id)
    	->first();
    }
}
