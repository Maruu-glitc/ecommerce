{{-- ================================================
FILE: resources/views/profile/partials/update-avatar-form.blade.php
FUNGSI: Form Update Foto Profil (Modern Foodmart Style)
================================================ --}}

<style>
    /* Avatar Container dengan gaya Boxy */
    .fm-avatar-card {
        border: 2px dashed #dee2e6;
        border-radius: 12px;
        padding: 20px;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }

    .fm-avatar-card:hover {
        border-color: #FACE68;
    }

    .avatar-wrapper {
        position: relative;
        width: 120px;
        height: 120px;
        flex-shrink: 0;
    }

    .avatar-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Mengubah dari bulat ke kotak dengan sedikit radius */
        border-radius: 12px; 
        border: 3px solid #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    /* Tombol Hapus mengambang di pojok */
    .avatar-delete {
        position: absolute;
        top: -10px;
        right: -10px;
        width: 28px;
        height: 28px;
        padding: 0;
        border-radius: 6px; /* Kotak sedikit radius */
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        z-index: 10;
    }

    /* Styling Input File */
    .fm-file-input::file-selector-button {
        background-color: #2D3436;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        margin-right: 15px;
        cursor: pointer;
        transition: 0.2s;
    }

    .fm-file-input::file-selector-button:hover {
        background-color: #000;
        color: #000;
    }

    /* Tombol Konsisten Foodmart */
    .btn-foodmart {
        background-color: #FACE68;
        border-color: #FACE68;
        color: #fff;
        border-radius: 8px !important;
        font-weight: 600;
        padding: 10px 24px;
    }

    .btn-foodmart:hover {
        background-color: #FACE68;
        color: #fff;
        transform: translateY(-2px);
    }
</style>

<div class="fm-avatar-card mb-4">
    <div class="row align-items-center g-4">
        
        {{-- Kolom 1: Preview Foto (Grid 1) --}}
        <div class="col-auto">
            <div class="avatar-wrapper">
                <img
                    id="avatar-preview"
                    src="{{ auth()->user()->avatar
                            ? asset('storage/' . $user->avatar )
                            : asset('images/imageUser2.jpg') }}"
                    alt="{{ $user->name }}">

                @if ($user->avatar)
                    <button type="button"
                        onclick="if(confirm('Hapus foto profil?')) document.getElementById('delete-avatar-form').submit()"
                        class="btn btn-danger avatar-delete"
                        title="Hapus foto">
                        <i class="bi bi-x-lg"></i>
                    </button>
                @endif
            </div>
        </div>

        {{-- Kolom 2: Info & Input (Grid 2) --}}
        <div class="col">
            <h5 class="fw-bold text-dark mb-1">Foto Profil</h5>
            <p class="text-muted small mb-3">
                Upload foto baru untuk mengubah identitas visualmu. <br>
                <span class="badge bg-white text-muted border fw-normal mt-1">JPG, PNG, WebP (Max. 2MB)</span>
            </p>

            <form method="POST" action="{{ route('profile.avatar') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input type="file"
                        name="avatar"
                        id="avatar-input"
                        accept="image/*"
                        onchange="previewAvatar(event)"
                        class="form-control fm-file-input @error('avatar') is-invalid @enderror">
                    
                    @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Grid Tombol Aksi --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-foodmart">
                        <i class="bi bi-cloud-arrow-up me-2"></i>Simpan Perubahan
                    </button>
                    <button type="button" class="btn btn-outline-secondary" onclick="resetPreview()">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Form Hapus Avatar (Hidden) --}}
<form id="delete-avatar-form" action="{{ route('profile.avatar.destroy') }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

<script>
    const defaultAvatar = "{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/default-avatar.png') }}";

    function previewAvatar(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('avatar-preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    function resetPreview() {
        document.getElementById('avatar-preview').src = defaultAvatar;
        document.getElementById('avatar-input').value = "";
    }
</script>