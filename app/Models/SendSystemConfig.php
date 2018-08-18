<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class SendSystemConfig extends Eloquent
{
    protected $collection = 'send_system_config';
    protected $fillable = ['subject','phone','email'];
}
