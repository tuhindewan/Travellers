<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class AccountApprovalEmail extends Eloquent
{
    protected $collection = 'account_approval_email';
    protected $fillable = ['subject','body'];
}
