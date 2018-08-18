<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class WebSettings extends Eloquent
{
    protected $collection = 'web_settings';
    protected $fillable = ['company_name','logo','address','email','phone','fav_icon'];
   
   
}
