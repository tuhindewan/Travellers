<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class PageSettings extends Eloquent
{
    protected $collection = 'page_settings';
    protected $fillable = ['terms_conditions','privacy_policy'];
}
