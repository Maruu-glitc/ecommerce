{{-- ================================================
FILE: resources/views/partials/flash-messages.blade.php
FUNGSI: Notifikasi Modern Aesthetic (Distro Style)
================================================ --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* Kustomisasi global SweetAlert2 agar senada dengan UI Distro */
    .swal2-popup {
        border-radius: 20px !important;
        padding: 2rem !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }
    .swal2-title {
        font-weight: 800 !important;
        letter-spacing: -0.5px !important;
        color: #121212 !important;
    }
    .swal2-html-container {
        color: #666 !important;
        font-size: 0.95rem !important;
    }
    .swal2-confirm {
        border-radius: 12px !important;
        font-weight: 700 !important;
        padding: 12px 30px !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
    }
</style>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        iconColor: '#FFD41D', {{-- Aksen warna utama --}}
        title: 'SUCCESS!',
        text: @json(session('success')),
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false,
        background: '#ffffff',
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        iconColor: '#ff4d4d',
        title: 'Opps!',
        text: @json(session('error')),
        confirmButtonColor: '#121212', {{-- Hitam pekat agar kontras --}}
        confirmButtonText: 'TRY AGAIN',
        background: '#ffffff',
    });
</script>
@endif

@if(session('info'))
<script>
    Swal.fire({
        icon: 'info',
        iconColor: '#FFD41D',
        title: 'INFO',
        text: @json(session('info')),
        confirmButtonColor: '#FFD41D',
        confirmButtonText: '<span style="color:#121212">GOT IT</span>',
        background: '#ffffff',
    });
</script>
@endif

@if($errors->any())
<script>
    Swal.fire({
        icon: 'warning',
        iconColor: '#FFD41D',
        title: 'CHECK AGAIN',
        html: `
            <div style="text-align:left; font-size: 0.85rem; background: #f9f9f9; padding: 15px; border-radius: 12px;">
                <ul style="margin:0; padding-left: 20px; color: #444;">
                    @foreach ($errors->all() as $error)
                        <li style="margin-bottom: 5px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        `,
        confirmButtonColor: '#121212',
        confirmButtonText: 'FIX IT',
    });
</script>
@endif