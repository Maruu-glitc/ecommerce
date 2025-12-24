@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <h1 class="fs-3 fw-bold mb-4">Checkout</h1>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf

            <div class="row g-4">
                {{-- Form Alamat --}}
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h2 class="fs-5 fw-semibold mb-4">Informasi Pengiriman</h2>

                            <div class="mb-3">
                                <label class="form-label">Nama Penerima</label>
                                <input
                                    type="text"
                                    name="name"
                                    value="{{ auth()->user()->name }}"
                                    class="form-control"
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nomor Telepon</label>
                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea
                                    name="address"
                                    rows="3"
                                    class="form-control"
                                    required
                                ></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Order Summary --}}
                <div class="col-lg-4">
                    <div class="card shadow-sm position-sticky" style="top: 1rem;">
                        <div class="card-body">
                            <h2 class="fs-5 fw-semibold mb-4">Ringkasan Pesanan</h2>

                            <div class="mb-4" style="max-height: 240px; overflow-y: auto;">
                                @foreach($cart->items as $item)
                                    <div class="d-flex justify-content-between small mb-2">
                                        <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                                        <span class="fw-medium">
                                            {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between fs-5 fw-bold mb-3">
                                <span>Total</span>
                                <span>
                                    Rp {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}
                                </span>
                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary w-100 py-2 fw-semibold"
                            >
                                Buat Pesanan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection