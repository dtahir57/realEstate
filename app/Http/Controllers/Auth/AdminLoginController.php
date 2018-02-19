<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class AdminLoginController extends Controller
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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
     /**
      * Attempt to log the user into the application.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return bool
      */
     protected function attemptLogin(Request $request)
     {
         return $this->guard()->attempt(
             $this->credentials($request), $request->filled('remember')
         );
     }
     public function logout(Request $request)
     {
         $this->guard()->logout();

         //$request->session()->invalidate();

         return redirect('/admin/login')->with('msg', 'You\'re logged out');
     }
    protected function guard()
    {
        return Auth::guard('admin');
    }
    public function showLoginForm()
    {
        return view('auth.admin_login');
    }

}
