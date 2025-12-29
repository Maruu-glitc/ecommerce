@extends('layouts.app')

@section('content')

<style>
    .checkout-title {
        font-weight: 600;
        letter-spacing: .2px;
    }

    .checkout-card {
        border: 0;
        border-radius: 14px;
    }

    .form-control,
    textarea {
        border-radius: 10px;
        padding: .6rem .75rem;
    }

    .form-control:focus,
    textarea:focus {
        border-color: #8CA9FF;
        box-shadow: 0 0 0 .15rem rgba(140, 169, 255, .25);
    }

    .summary-item {
        font-size: .9rem;
    }

    .btn-checkout {
        background-color: #8CA9FF;
        border-color: #8CA9FF;
        border-radius: 9px;
        font-weight: 600;
    }

    .btn-checkout:hover {
        background-color: #7896f0;
        border-color: #7896f0;
    }
</style>

<div class="container py-4">
    <h1 class="fs-4 checkout-title mb-4">Checkout</h1>
    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="row g-4">

            {{-- Informasi Pengiriman --}}
            <div class="col-lg-8">
                <div class="card checkout-card shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="fs-6 fw-semibold mb-4">Informasi Pengiriman</h2>

                        <div class="mb-3">
                            <label class="form-label small">Nama Penerima</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small">Nomor Telepon</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <div class="mb-0">
                            <label class="form-label small">Alamat Lengkap</label>
                            <textarea name="address" rows="3" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Ringkasan --}}
            <div class="col-lg-4">
                <div class="card checkout-card shadow-sm position-sticky" style="top: 1rem;">
                    <div class="card-body p-4">

                        <h2 class="fs-6 fw-semibold mb-3">Ringkasan Pesanan</h2>

                        <div class="mb-3" style="max-height: 220px; overflow-y: auto;">
                            @foreach($cart->items as $item)
                            <div class="d-flex justify-content-between summary-item mb-2">
                                <span class="text-muted">
                                    {{ Str::limit($item->product->name, 32) }}
                                    × {{ $item->quantity }}
                                </span>
                                <span class="fw-medium">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </span>
                            </div>
                            @endforeach
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between fw-semibold fs-5 mb-4">
                            <span>Total</span>
                            <span>
                                Rp {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}
                            </span>
                        </div>

                        <button type="submit" class="btn btn-checkout w-100 py-2">
                            Buat Pesanan
                        </button>

                        <p class="text-muted text-center small mt-3 mb-0">
                            Pastikan alamat sudah benar sebelum melanjutkan
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

@endsection