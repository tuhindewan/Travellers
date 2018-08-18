<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class SmtpSettings extends Eloquent
{
    protected $collection = 'smtp_settings';
    protected $fillable = ['host','port','user','password'];
}
