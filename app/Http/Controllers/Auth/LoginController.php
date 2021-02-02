<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $maxAttempts = 3;
    protected $decayMinutes = 3;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $inputVal = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(array('email' => $inputVal['email'], 'password' => $inputVal['password']))) {
            if (auth()->user()->is_admin == 1 && auth()->user()->status == 1) {
                return redirect()->route('admin.route');
            } else  if (auth()->user()->is_admin == 2 ) {
                return redirect()->route('staff.route');
            } 
            else  if (auth()->user()->is_admin =='' && auth()->user()->status == '' ) {
                return redirect()->route('home');
            } 
            else {
                return redirect()->route('welcome');
            }
        } else {
            return redirect()->route('login')
                ->with('message', 'Email & Password are incorrect.');
        }
    }
}
