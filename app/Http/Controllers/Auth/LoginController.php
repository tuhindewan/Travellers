<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
  
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest',['except'=>['logout','userLogout']]);
    }

    public function userLogout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }


     /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    // protected function credentials(Request $request)
    // {
    //     $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
    //         ? $this->username()
    //         : 'username';

    //     return [
    //         $field => $request->get($this->username()),
    //         'password' => $request->password,
    //     ];
    // }

    // public function username()
    // {
    //    $login = request()->input('login');
    //    $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    //    request()->merge([$field => $login]);
    //    return $field;
    // }
}
