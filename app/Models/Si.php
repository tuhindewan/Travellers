<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class Si extends Eloquent
{
    protected $collection = 'SEO_settings';
    protected $fillable = ['seo_settings','social_network _reach','alexa_traffic_metrics','alexa_traffic_graphs','search_index'];
   
   
}
