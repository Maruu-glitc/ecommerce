<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo(): string
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return route('admin.dashboard');
        }

        return route('home');
    }

    protected function validateLogin(Request $request): void
    {
        $request->validate([
            $this->username() => 'required|string|email',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'Email harus di isi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password harus di isi',
            'password.min' => 'Password minimal 8 karakter',
        ]);
    }
}
