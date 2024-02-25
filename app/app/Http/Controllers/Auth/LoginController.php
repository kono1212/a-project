<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // ログイン成功時の処理
            $user = Auth::user();
            if ($user->del_flag == 1) {
                return view('suspended_user');
            } elseif ($user->role === 0) {
                return view('ownerpage');
            } else {
                return redirect()->intended('/');
            }
        }

        // ログイン失敗時の処理
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
