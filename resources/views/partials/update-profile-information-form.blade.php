{{-- ================================================
FILE: resources/views/profile/partials/update-profile-information-form.blade.php
FUNGSI: Update Info Profil (Modern Foodmart Style)
================================================ --}}

<style>
    /* Styling Input & Layout */
    .fm-info-card {
        background-color: #ffffff;
    }

    .fm-input-group {
        position: relative;
    }

    .fm-input-group i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #9FCAD6;
        z-index: 10;
    }

    /* Khusus untuk Textarea agar ikon tetap di atas */
    .fm-input-group.align-top i {
        top: 20px;
        transform: none;
    }

    .fm-form-control {
        padding-left: 45px !important;
        border-radius: 8px !important;
        border: 1px solid #dee2e6;
        padding: 12px;
        transition: all 0.3s ease;
    }

    .fm-form-control:focus {
        border-color: #9FCAD6;
        box-shadow: 0 0 0 0.25rem rgba(159, 202, 214, 0.25);
    }

    /* Tombol Boxy Modern */
    .btn-foodmart {
        background-color: #9FCAD6;
        border-color: #9FCAD6;
        color: #fff;
        border-radius: 8px !important;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-foodmart:hover {
        background-color: #8bb7c2;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(159, 202, 214, 0.3);
    }

    .form-label {
        font-weight: 600;
        font-size: 0.9rem;
        color: #2D3436;
        margin-bottom: 8px;
    }

    .verification-notice {
        background-color: #fff8e1;
        border-radius: 8px;
        padding: 12px;
        border: 1px solid #ffe082;
    }
</style>

<div class="fm-info-card">
    <div class="mb-4">
        <h5 class="fw-bold mb-1">Informasi Dasar</h5>
        <p class="text-muted small">Perbarui informasi profil dan alamat pengiriman kamu secara berkala.</p>
    </div>

   

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="row g-4">
            {{-- Nama Lengkap (Grid 1) --}}
            <div class="col-md-6">
                <label for="name" class="form-label">Nama Lengkap</label>
                <div class="fm-input-group">
                    <i class="bi bi-person"></i>
                    <input type="text" name="name" id="name" 
                        class="form-control fm-form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}" required autofocus placeholder="Contoh: Budi Santoso">
                </div>
                @error('name')
                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email (Grid 2) --}}
            <div class="col-md-6">
                <label for="email" class="form-label">Alamat Email</label>
                <div class="fm-input-group">
                    <i class="bi bi-envelope"></i>
                    <input type="email" name="email" id="email" 
                        class="form-control fm-form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}" required placeholder="nama@email.com">
                </div>
                @error('email')
                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                @enderror

                {{-- Email Verification Notice --}}
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="verification-notice mt-3">
                    <p class="text-dark small mb-1">
                        <i class="bi bi-exclamation-triangle-fill text-warning me-1"></i>
                        Email kamu belum diverifikasi.
                    </p>
                    <button form="send-verification" class="btn btn-link p-0 small text-primary fw-bold text-decoration-none">
                        Kirim ulang link verifikasi
                    </button>
                    @if (session('status') === 'verification-link-sent')
                    <p class="text-success small fw-bold mt-2 mb-0">
                        Link baru telah dikirim!
                    </p>
                    @endif
                </div>
                @endif
            </div>

            {{-- Nomor Telepon (Grid 3) --}}
            <div class="col-md-6">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <div class="fm-input-group">
                    <i class="bi bi-whatsapp"></i>
                    <input type="tel" name="phone" id="phone" 
                        class="form-control fm-form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx">
                </div>
                <div class="form-text small opacity-75">Gunakan format angka aktif.</div>
                @error('phone')
                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Alamat (Full Width) --}}
            <div class="col-12">
                <label for="address" class="form-label">Alamat Lengkap Pengiriman</label>
                <div class="fm-input-group align-top">
                    <i class="bi bi-geo-alt"></i>
                    <textarea name="address" id="address" rows="3" 
                        class="form-control fm-form-control @error('address') is-invalid @enderror"
                        placeholder="Tuliskan nama jalan, blok, atau patokan rumah">{{ old('address', $user->address) }}</textarea>
                </div>
                @error('address')
                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Footer Aksi --}}
            <div class="col-12 mt-4 pt-3 border-top">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-foodmart px-4 py-2">
                            <i class="bi bi-check2-circle me-2"></i>Simpan Informasi
                        </button>
                    </div>
                    <div class="col-auto">
                        @if (session('status') === 'profile-updated')
                            <span class="text-success fw-bold small animate__animated animate__fadeIn">
                                <i class="bi bi-check-lg"></i> Berhasil diperbarui
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>