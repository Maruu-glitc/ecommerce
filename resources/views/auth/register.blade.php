@extends('layouts.app')

@section('content')

<div class="auth-wrapper">
    <div class="auth-card">
        {{-- Header --}}
        <div class="auth-header">
            <h3>Buat Akun Baru</h3>
            <p>Daftar untuk mulai menggunakan aplikasi</p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name --}}
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror" placeholder="Nama kamu" required autofocus>
                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group mt-3">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror" placeholder="nama@email.com" required>
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

            {{-- Confirm Password --}}
            <div class="form-group mt-3">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••"
                    required>
            </div>

            {{-- Button --}}
            <button class="btn-auth mt-4">Register</button>

            {{-- Divider --}}
            {{-- <div class="divider"></div> --}}

            {{-- Login --}}
            <p class="switch-text mt-3">
                <a href="{{ route('login') }}"><span>sudah punya akun? </span>Login Sekarang</a>
            </p>
        </form>
    </div>
</div>
@endsection

<style>
    span{
        color: #000000af;
    }
    /* Wrapper */
    .auth-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #7faab6, #ffffff);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Inter', sans-serif;
    }

    /* Card */
    .auth-card {
        width: 100%;
        max-width: 460px;
        background: #ffffff;
        border-radius: 22px;
        padding: 38px;
        box-shadow: 0 25px 45px rgba(0, 0, 0, 0.08);
    }

    /* Header */
    .auth-header {
        text-align: center;
        margin-bottom: 28px;
    }

    .auth-header h3 {
        font-weight: 700;
        color: #1f2937;
    }

    .auth-header p {
        font-size: 14px;
        color: #6b7280;
    }

    /* Input */
    .form-control {
        border-radius: 14px;
        padding: 12px 14px;
        border: 1px solid #e5e7eb;
    }

    .form-control:focus {
        border-color: #8CA9FF;
        box-shadow: 0 0 0 3px rgba(140, 169, 255, .25);
    }

    /* Button */
    .btn-auth {
        width: 100%;
        border: none;
        padding: 13px;
        border-radius: 16px;
        background: linear-gradient(135deg, #7faab6, #a8d3df);
        color: #ffffff;
        font-weight: 600;
        transition: .3s ease;
    }

    .btn-auth:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 22px rgba(140, 169, 255, .45);
    }

    /* Divider */
    .divider {
        margin: 22px 0 10px;
        text-align: center;
        font-size: 13px;
        color: #9ca3af;
    }

    /* Switch */
    .switch-text {
        text-align: center;
        font-size: 14px;
    }

    .switch-text a {
        color: #7faab6;
        font-weight: 600;
        text-decoration: none;
    }

    .switch-text a:hover {
        text-decoration: underline;
    }
</style>    