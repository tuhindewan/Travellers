<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class AgencySocial extends Eloquent
{
    protected $collection = 'agencies_social';
    protected $fillable = ['fk_agency_id','social_name','link'];

    public static function updateSocialData($id, $link, $social_name)
    {
    	return DB::collection('agencies_social')
        ->where('_id', $id)
        ->update([
            'social_name' => $social_name,
            'link' => $link
            ]);
    }
}
