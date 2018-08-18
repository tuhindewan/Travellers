<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class AgencyGallery extends Eloquent
{
    protected $collection = 'agencies_gallery';
    protected $fillable = ['fk_agency_id','caption','file','type','status'];
}
