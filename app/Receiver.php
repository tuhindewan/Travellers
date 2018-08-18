<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Receiver extends Eloquent
{
	protected $collection = 'receivers';
	protected $fillable = ['user_id','message_id','status'];


    public function user() 
    {
    	return $this->belongsTo('App\User');
    }

    public function message() 
    {
    	return $this->belongsTo('App\Message');
    }
}
