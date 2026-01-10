{{-- ================================================
FILE: resources/views/profile/partials/update-password-form.blade.php
FUNGSI: Form Update Password (Modern Foodmart Style)
================================================ --}}

<style>
    /* Konsistensi Foodmart Styling */
    .fm-password-card {
        background-color: #ffffff;
        border-radius: 12px;
    }

    .fm-input-group {
        position: relative;
    }

    .fm-input-group i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #FACE68;
        z-index: 10;
    }

    .fm-form-control {
        padding-left: 45px !important;
        border-radius: 8px !important;
        border: 1px solid #dee2e6;
        padding: 12px;
        transition: all 0.3s ease;
    }

    .fm-form-control:focus {
        border-color: #FACE68;
        box-shadow: 0 0 0 0.25rem #FACE6833;
    }

    /* Tombol Boxy Modern */
    .btn-foodmart {
        background-color: #FACE68;
        border-color: #FACE68;
        color: #fff;
        border-radius: 8px !important;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-foodmart:hover {
        background-color: #FACE68;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px #face6844;
    }

    .btn-outline-secondary {
        border-radius: 8px !important;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.9rem;
        color: #6d5f3d;
    }
</style>

<div class="fm-password-card">
    <div class="mb-4">
        <h5 class="fw-bold mb-1">Keamanan Akun</h5>
        <p class="text-muted small">Pastikan akun kamu aman dengan menggunakan password yang panjang dan acak.</p>
    </div>

    <form method="post" action="{{ route('profile.password.update') }}">
        @csrf
        @method('put')

        <div class="row g-3">
            {{-- Current Password --}}
            <div class="col-12">
                <label for="current_password" class="form-label">Password Saat Ini</label>
                <div class="fm-input-group">
                    <i class="bi bi-shield-lock"></i>
                    <input type="password" name="current_password" id="current_password"
                        class="form-control fm-form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                        placeholder="Masukkan password lama" autocomplete="current-password">
                </div>
                @error('current_password', 'updatePassword')
                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Grid untuk Password Baru & Konfirmasi (Sampingan di Desktop) --}}
            <div class="col-md-6">
                <label for="password" class="form-label">Password Baru</label>
                <div class="fm-input-group">
                    <i class="bi bi-key"></i>
                    <input type="password" name="password" id="password"
                        class="form-control fm-form-control @error('password', 'updatePassword') is-invalid @enderror" 
                        placeholder="Password minimal 8 karakter" autocomplete="new-password">
                </div>
                @error('password', 'updatePassword')
                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                <div class="fm-input-group">
                    <i class="bi bi-check2-circle"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control fm-form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                        placeholder="Ulangi password baru" autocomplete="new-password">
                </div>
                @error('password_confirmation', 'updatePassword')
                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Grid Tombol --}}
            <div class="col-12 mt-4">
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-foodmart px-4 py-2">
                            <i class="bi bi-arrow-repeat me-2"></i>Update Password
                        </button>
                    </div>
                    
                    <div class="col-auto">
                        @if (session('status') === 'password-updated')
                            <div class="alert alert-success py-2 px-3 mb-0 small border-0 fade-out" style="border-radius: 8px;">
                                <i class="bi bi-check-circle-fill me-1"></i> Berhasil disimpan.
                            </div>
                            <script>
                                setTimeout(() => {
                                    const fadeEl = document.querySelector('.fade-out');
                                    if(fadeEl) fadeEl.style.transition = 'opacity 0.5s';
                                    if(fadeEl) fadeEl.style.opacity = '0';
                                    setTimeout(() => fadeEl.style.display = 'none', 500);
                                }, 3000);
                            </script>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>