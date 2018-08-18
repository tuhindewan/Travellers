<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class AgencyServices extends Eloquent
{
    protected $collection = 'agencies_service';
    protected $fillable = ['fk_agency_id','service_name','image','description','position','status'];
}
