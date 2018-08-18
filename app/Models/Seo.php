<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class Seo extends Eloquent
{
    protected $collection = 'seo_settings';
    protected $fillable = ['keyword','author','revised_after','description','sitemap_link'];
   
   
}
