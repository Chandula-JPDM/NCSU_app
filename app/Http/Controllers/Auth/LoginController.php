<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

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

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::PROFILE;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:administration')->except('logout');
        $this->middleware('guest:student')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('student')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = auth('student')->user()->username;
            return $request->wantsJson()
                                ? new JsonResponse([], 204)
                                : redirect()->intended('uop/'.$user);
        }

        if (Auth::guard('administration')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
 
            return $request->wantsJson()
                                ? new JsonResponse([], 204)
                                : redirect()->intended('profile');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        if(Auth::guard('administration')->check()){
            Auth::guard('administration')->logout();
        }

        else if(Auth::guard('student')->check()){
            Auth::guard('student')->logout();
        }
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

}
