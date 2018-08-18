<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class AgenciesPostImage extends Eloquent
{
    protected $collection = 'agencies_post_image';
    protected $fillable = ['fk_post_id','images'];

    public function agencies_post(){
        return $this->belongsTo('App\Models\AgenciesPost','fk_post_id');
    }
}
