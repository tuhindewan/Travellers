<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class AgencyAbout extends Eloquent
{
    protected $collection = 'agencies_about';
    protected $fillable = ['fk_agency_id','agency_name','logo','cover_image','description','license_key','website','email','phone','fk_place_id','impressum','awards','products','mission','founding_date'];

    public static function checkExistAgency($id)
    {
    	return DB::collection('agencies_about')
    	->where('fk_agency_id',$id)
    	->first();
    }

    public function places() {

        return $this->belongsTo('App\Models\CountryPlace','fk_place_id');
    }
}
