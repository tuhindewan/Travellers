<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use App\Notifications\AdminResetPasswordNotification;
use App\Admin;
use App\Models\Role;
use App\Models\UserWiseRole;
use DB;
class Admin extends Eloquent  implements Authenticatable
{
    use AuthenticableTrait;
    protected $collection = 'admin';
    protected $fillable = ['username', 'email', 'password','firstname','lastname','status','address','phone','created_by'];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

    /*get admin wise role*/
    public static function getUserAdminWiseRole(){
    	// return DB::collection('admin')
    	// ->leftJoin('user_wise_roles','admin._id','=','user_wise_roles.fk_user_id')
    	
    	// ->get();

    	$data = Admin::all();

    	
        return Admin::raw(function($collection)
        {
            return $collection->aggregate(
                [[
                    '$lookup' => [
                        'as'=>'info',
                        'from'=>'admin_wise_roles',
                        'foreignField'=>'fk_user_id',
                        'localField'=>'_id'
                    ]
                ]]
            );
        });
    	
    	//$data = $data->whereRaw(array( '$lookup' => array('as':'field','from':'collection','foreignfield':'somefield','localfield':'somefield') ))
    }

    /*get admin wise role*/
    public static function checkExtAdmin($adminId, $password){
        $checkExt = DB::table('admin')
        ->where('_id',$adminId)
        ->where('password',$password)
        ->first();

        if(count($checkExt)>0){
            return true;
        }
        return false;
    }
}
