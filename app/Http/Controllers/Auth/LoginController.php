<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $request->validate([
            "username" => 'required',
            "password" => 'required'
       ]);

       $credentials = $request->only('username', 'password');

       if(auth()->attempt($credentials)){
            
        
        switch (auth()->user()->role){
            case 'student':
                return redirect('/');
                break;
            case 'official':
                return redirect('/official');
                break;
            case 'admin':
                return redirect('/admin');
                break;
        }
            
       }

       return redirect('login')->with('failed', "Credentials Incorrect!");
    }

    public function logout(){

        Session::flush();
        Auth::logout();
        Session::regenerateToken();

        return redirect('login');
    }
}
