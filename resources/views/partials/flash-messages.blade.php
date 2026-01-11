{{-- ================================================
FILE: resources/views/partials/flash-messages.blade.php
FUNGSI: Notifikasi Modern Aesthetic (Distro Style)
================================================ --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* Animasi slide dari kanan ke kiri */
    @keyframes slideFromRight {
        0% {
            transform: translateX(100%);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideToRight {
        0% {
            transform: translateX(0);
            opacity: 1;
        }
        100% {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    .swal2-slide-from-right {
        animation: slideFromRight 0.5s forwards !important;
    }
    
    .swal2-slide-to-right {
        animation: slideToRight 0.5s forwards !important;
    }

    .swal2-container {
        z-index: 9999 !important;
        border-radius: 15px !important;
    }

    </style>
    
    <script>
    @if(session('success'))
    Swal.fire({
        toast: true,
        position: 'top-end', // tetap di kanan atas
        icon: 'success',
        iconColor: '#FFC400',
        title: @json(session('success')),
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        background: '#ffffff',
        showClass: { popup: 'swal2-show swal2-slide-from-right' },
        hideClass: { popup: 'swal2-hide swal2-slide-to-right' }
    });
    @endif
    
    @if(session('error'))
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'error',
        title: @json(session('error')),
        showConfirmButton: false,
        timer: 4000,
        background: '#ffffff',
        showClass: { popup: 'swal2-show swal2-slide-from-right' },
        hideClass: { popup: 'swal2-hide swal2-slide-to-right' }
    });
    @endif
    
    @if($errors->any())
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'warning',
        title: 'CHECK AGAIN',
        html: `
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        `,
        showConfirmButton: true,
        confirmButtonText: 'FIX IT',
        showClass: { popup: 'swal2-show swal2-slide-from-right' },
        hideClass: { popup: 'swal2-hide swal2-slide-to-right' }
    });
    @endif
    </script>
    