<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class Atm extends Eloquent
{
    protected $collection = 'Alexa Traffic Metrics';
    protected $fillable = ['last_3_months','country_specific'];
   
   
}
