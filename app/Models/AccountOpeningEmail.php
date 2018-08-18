<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class AccountOpeningEmail extends Eloquent
{
    protected $collection = 'account_opening_email';
    protected $fillable = ['subject','body'];
}
