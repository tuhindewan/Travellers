<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class FeedNotification extends Eloquent
{
	public $with = ['users','posts'];
    protected $collection = 'feed_notification';
    protected $fillable = ['fk_user_id', 'thread_id', 'thread_type','body_text','is_unread','focus'];

    public function users(){
        return $this->belongsTo('App\User','fk_user_id');
    }

    public function posts(){
        return $this->belongsTo('App\Models\Posts','thread_id');
    }
}
