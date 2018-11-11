<?php

namespace U\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use U\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use U\User;

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
    protected $redirectTo = '/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $credential = ['email' => $request->email, 'password' => $request->password ];

        if (Auth::attempt($credential)) {
            $user = User::where('email', $request->email)->first();

            if ($user->isAdmin()) {
                return redirect('users');
            }

            return redirect('profile');
        }

        return redirect()->back();
    }
}
