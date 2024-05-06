<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/login';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function adminLogin()
    {
        return view('auth.login-admin');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::guard('admin')->attempt(
            $request->only('email', 'password'),
            $request->filled('remember')
        )) {
            return redirect(route('admin.users.show'));
        }

        return back()->withErrors([
            'email' => trans('auth.failed'),
        ]);
    }

    protected function loggedOut(Request $request)
    {
        return redirect()->route('admin.login');
    }
}
