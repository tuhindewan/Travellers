<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class AgenciesPost extends Eloquent
{
	public $with = ['agencies_post_image'];

    protected $collection = 'agencies_post';
    protected $fillable = ['fk_agency_id','post_type','fk_place_id','status','description','hits_count'];

    public function agencies_post_image()
    {
    	return $this->hasMany('App\Models\AgenciesPostImage','fk_post_id');
    }

    public function places() {

        return $this->belongsTo('App\Models\CountryPlace','fk_place_id');
    }


}
