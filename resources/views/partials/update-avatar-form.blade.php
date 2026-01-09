{{-- resources/views/profile/partials/update-avatar-form.blade.php --}}

<style>
    .avatar-wrapper {
        position: relative;
        width: 110px;
        height: 110px;
    }

    .avatar-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #f1f1f1;
    }

    .avatar-delete {
        position: absolute;
        top: -6px;
        right: -6px;
        width: 26px;
        height: 26px;
        padding: 0;
        border-radius: 50%;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<p class="text-muted small mb-3">
    Upload foto profil kamu. Format: JPG, PNG, WebP. Maksimal 2MB.
</p>

<form method="POST" action="{{ route('profile.avatar') }}" enctype="multipart/form-data">
    @csrf

    <div class="d-flex align-items-center gap-4 flex-wrap">

        {{-- Avatar Preview --}}
        <div class="avatar-wrapper">
            <img
                id="avatar-preview"
                src="{{ $user->avatar
                        ? asset('storage/' . $user->avatar)
                        : asset('images/default-avatar.png') }}"
                alt="{{ $user->name }}">

            @if ($user->avatar)
                <button type="button"
                    onclick="if(confirm('Hapus foto profil?')) document.getElementById('delete-avatar-form').submit()"
                    class="btn btn-danger avatar-delete"
                    title="Hapus foto">
                    &times;
                </button>
            @endif
        </div>

        {{-- Upload Input --}}
        <div class="flex-grow-1">
            <label class="form-label fw-semibold">Pilih Foto Baru</label>
            <input type="file"
                name="avatar"
                accept="image/*"
                onchange="previewAvatar(event)"
                class="form-control @error('avatar') is-invalid @enderror">

            @error('avatar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-upload me-1"></i> Simpan Foto
        </button>
    </div>
</form>

{{-- Form Hapus Avatar --}}
<form id="delete-avatar-form" action="{{ route('profile.avatar.destroy') }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

<script>
    function previewAvatar(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('avatar-preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
</script>
