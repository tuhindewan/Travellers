<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class PasswordResetEmail extends Eloquent
{
    protected $collection = 'password_reset_email';
    protected $fillable = ['subject','body'];

    
}
