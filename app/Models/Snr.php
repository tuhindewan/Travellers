<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class Snr extends Eloquent
{
    protected $collection = 'Social Network Reach';
    protected $fillable = ['facebook_interactions','twitter_mentions','google_plus','linkedin_shares','pinterest_shares'];
   
   
}
