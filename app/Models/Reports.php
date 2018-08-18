<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
class Reports extends Eloquent
{
	public $with = ['users','report_users','report_post'];
    protected $collection = 'reports';
    protected $fillable = ['fk_user_id', 'category','type','description','report_type_id','status'];

    public function users(){
        return $this->belongsTo('App\User','fk_user_id');
    }

    public function report_users(){
        return $this->belongsTo('App\User','report_type_id');
    }

    public function report_post(){
        return $this->belongsTo('App\Models\Posts','report_type_id');
    }

    public static function checkReport($type, $id)
    {
        return DB::collection('reports')
        ->where('type', $type)
        ->where('report_type_id', $id)
        ->get();
    }
}
