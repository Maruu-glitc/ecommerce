@extends('layouts.app')

@section('content')
<div class="login-wrapper">
    <div class="login-card">
        {{-- Header --}}
        <div class="login-header">
            <h3>Welcome Back</h3>
            <p>Silakan login ke akun kamu</p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror" placeholder="nama@email.com" required
                    autofocus>
                @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group mt-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="••••••••" required>
                @error('password')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Remember --}}
            <div class="remember-row">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Ingat saya
                </label>

                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Lupa password?</a>
                @endif
            </div>

            {{-- Button --}}
            <button class="btn-login">Login</button>

            {{-- Divider --}}
            <div class="divider"><hr>atau<hr></div>

            {{-- Google --}}
            <a href="{{ url('auth/google') }}" class="btn-google">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg">
                Login dengan Google
            </a>

            {{-- Register --}}
            <p class="register-text">
                Belum punya akun?
                <a href="{{ route('register') }}">Daftar Sekarang</a>
            </p>
        </form>
    </div>
</div>
@endsection

<style>
    /* Background */
    .login-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #8CA9FF, #ffffff);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Inter', sans-serif;
    }
    
    /* Card */
    .login-card {
        width: 100%;
        max-width: 420px;
        background: #ffffff;
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    }
    
    /* Header */
    .login-header {
        text-align: center;
        margin-bottom: 25px;
    }
    .login-header h3 {
        font-weight: 700;
        color: #1f2937;
    }
    .login-header p {
        color: #6b7280;
        font-size: 14px;
    }
    
    /* Form */
    .form-control {
        border-radius: 12px;
        padding: 12px 14px;
        border: 1px solid #e5e7eb;
    }
    .form-control:focus {
        border-color: #8CA9FF;
        box-shadow: 0 0 0 3px rgba(140,169,255,.25);
    }
    
    /* Remember */
    .remember-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
        margin: 15px 0;
    }
    .remember-row a {
        color: #8CA9FF;
        text-decoration: none;
    }
    
    /* Login Button */
    .btn-login {
        width: 100%;
        border: none;
        padding: 12px;
        border-radius: 14px;
        background: linear-gradient(135deg, #8CA9FF, #6f8cff);
        color: #fff;
        font-weight: 600;
        transition: .3s;
    }
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(140,169,255,.4);
    }
    
    /* Divider */
    .divider {
        text-align: center;
        margin: 20px 0;
        font-size: 13px;
        color: #9ca3af;
    }
    
    /* Google Button */
    .btn-google {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        border: 1px solid #e5e7eb;
        padding: 11px;
        border-radius: 14px;
        text-decoration: none;
        color: #374151;
        font-weight: 500;
        transition: .3s;
    }
    .btn-google img {
        width: 18px;
    }
    .btn-google:hover {
        background: #f5f7ff;
        border-color: #8CA9FF;
    }
    
    /* Register */
    .register-text {
        margin-top: 20px;
        text-align: center;
        font-size: 14px;
    }
    .register-text a {
        color: #8CA9FF;
        font-weight: 600;
        text-decoration: none;
    }
    </style>
    