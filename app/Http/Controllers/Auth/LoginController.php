<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = '/home';
/**
     * Override the redirect path after login.
     *
     * @return string
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        // Redirect based on role
        switch ($user->role) {
            case 'developer':
                return '/admin/dashboard';
            case 'admin':
                return '/admin/dashboard';
            case 'staff':
                return '/staff/dashboard';
            case 'customer':
                return '/';
            default:
                return '/';
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
