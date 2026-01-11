
@extends('layouts.distro')

@section('content')

<div class="login-wrapper">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="auth-card">
                    {{-- Premium Brand Header --}}
                    <div class="auth-header text-center">
                        <div class="brand-logo">
                            <i class="fa-solid fa-shirt"></i>
                        </div>
                        <h2 class="auth-title">Welcome Back</h2>
                        <p class="auth-subtitle">Silahkan daftar untuk melihat kaos yang anda inginkan.</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="auth-form">
                        @csrf

                        <div class="input-group-custom">
                            <label class="label-sm">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control-premium @error('email') is-invalid @enderror" 
                                placeholder="e.g. user@distro.com" required autofocus>
                            @error('email')
                                <span class="error-msg">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group-custom">
                            <div class="d-flex justify-content-between">
                                <label class="label-sm">Password</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="link-subtle">Lupa Password?</a>
                                @endif
                            </div>
                            <input type="password" name="password" 
                                class="form-control-premium @error('password') is-invalid @enderror"
                                placeholder="••••••••" required>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check custom-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label label-sm" for="remember">Ingat saya</label>
                            </div>
                            
                        </div>

                        <button type="submit" class="btn-premium-action">
                            SIGN IN
                        </button>

                        <div class="divider-text">
                            <span>atau</span>
                        </div>

                        <a href="{{ url('auth/google') }}" class="btn-google-premium">
                            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" width="25">
                            Google Account
                        </a>

                        <div class="auth-footer text-center">
                            <p>Belum punya akun? <a href="{{ route('register') }}" class="link-primary-bold">Daftar</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');

    :root {
        --primary-accent: #FFD41D;
        --dark-space: #121212;
        --soft-gray: #fcfcfc;
        --border-color: #f1f1f1;
        --text-muted: #888888;
    }

    body {
        background-color: var(--soft-gray);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .login-wrapper {
        background: radial-gradient(circle at top right, #fff9e6 0%, #fcfcfc 40%);
    }

    /* Card Aesthetic */
    .auth-card {
        background: #ffffff;
        padding: 3rem 2.5rem;
        border-radius: 2rem;
        border: 1px solid rgba(0,0,0,0.02);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.04);
    }

    /* Brand Section */
    .brand-logo {
        width: 64px;
        height: 64px;
        background: var(--primary-accent);
        color: var(--dark-space);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 1.25rem;
        margin: 0 auto 1.5rem;
        font-size: 1.8rem;
        transform: rotate(-5deg); /* Slight tilt for streetwear vibe */
    }

    .auth-title {
        font-weight: 800;
        letter-spacing: -1px;
        color: var(--dark-space);
        margin-bottom: 0.5rem;
        font-size: 1.75rem;
    }

    .auth-subtitle {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-bottom: 2.5rem;
    }

    /* Form Styling */
    .input-group-custom {
        margin-bottom: 1.5rem;
    }

    .label-sm {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--dark-space);
        margin-bottom: 0.6rem;
        display: block;
    }

    .form-control-premium {
        width: 100%;
        padding: 0.85rem 1.2rem;
        border-radius: .50rem;
        border: 1px solid var(--border-color);
        background: #f9f9f9;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .form-control-premium:focus {
        outline: none;
        background: #fff;
        border-color: var(--primary-accent);
        box-shadow: 0 0 0 4px rgba(255, 212, 29, 0.1);
    }

    /* Buttons */
    .btn-premium-action {
        width: 100%;
        background: var(--dark-space);
        color: #fff;
        border: none;
        padding: .50rem;
        border-radius: 1rem;
        font-weight: 700;
        letter-spacing: 2px;
        margin-top: 1rem;
        transition: all 0.3s ease;
    }

    .btn-premium-action:hover {
        background: var(--primary-accent);
        color: var(--dark-space);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(255, 212, 29, 0.3);
    }

    .btn-google-premium {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        width: 100%;
        padding: 0.85rem;
        border-radius: 1rem;
        border: 1px solid var(--border-color);
        text-decoration: none;
        color: var(--dark-space);
        font-weight: 600;
        font-size: 0.9rem;
        transition: 0.3s;
    }

    .btn-google-premium:hover {
        background: #f1f1f1;
    }

    /* Divider */
    .divider-text {
        text-align: center;
        margin: 2rem 0;
        position: relative;
    }

    .divider-text::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        height: 1px;
        background: #eeeeee;
        z-index: 1;
    }

    .divider-text span {
        background: #fff;
        padding: 0 15px;
        position: relative;
        z-index: 2;
        color: #bbb;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 1px;
    }

    /* Links */
    .link-subtle {
        font-size: 0.75rem;
        color: var(--text-muted);
        text-decoration: none;
    }

    .link-primary-bold {
        color: var(--dark-space);
        font-weight: 700;
        text-decoration: none;
        border-bottom: 2px solid var(--primary-accent);
    }

    .auth-footer {
        margin-top: 2rem;
        font-size: 0.9rem;
    }

    .error-msg {
        color: #ff4d4d;
        font-size: 0.75rem;
        margin-top: 0.4rem;
        display: block;
    }
</style>