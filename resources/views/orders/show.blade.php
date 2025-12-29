@extends('layouts.app')

@section('content')

<style>
    .bg-brand {
        background-color: #8FABD4;
    }

    .bg-brand-soft {
        background: linear-gradient(135deg, #8CA9FF, #adbef0);
    }

    .badge-brand {
        background-color: rgba(143, 171, 212, 0.15);
        color: #4b6ea9;
    }

    .table thead th {
        font-weight: 500;
        color: #6c757d;
    }
    #pay-button{
        background-color: #8ab5ff;
    }
    #pay-button:hover{
        background-color: rgb(96, 124, 238);
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm overflow-hidden">

                {{-- Header Order --}}
                <div class="p-4 bg-brand-soft text-white">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h1 class="h4 fw-semibold mb-1">
                                Order #{{ $order->order_number }}
                            </h1>
                            <small class="opacity-75">
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </small>
                        </div>

                        {{-- Status --}}
                        <span class="badge rounded-pill px-4 py-2 fs-6
                            @switch($order->status)
                                @case('pending') bg-warning text-dark @break
                                @case('processing') bg-primary @break
                                @case('shipped') bg-info @break
                                @case('delivered') bg-success @break
                                @case('cancelled') bg-danger @break
                                @default bg-secondary
                            @endswitch
                        ">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>

                {{-- Produk --}}
                <div class="card-body p-4">
                    <h3 class="h6 fw-semibold mb-3">Produk yang Dipesan</h3>
                    <hr>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Harga</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">
                                        Rp {{ number_format($item->discount_price ?? $item->price, 0, ',', '.') }}
                                    </td>

                                    
                                    <td class="text-end fw-semibold">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                @if($order->shipping_cost > 0)
                                <tr>
                                    <td colspan="3" class="text-end pt-3">Ongkos Kirim</td>
                                    <td class="text-end pt-3">
                                        Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td colspan="3" class="text-end pt-3">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="text-end pt-3">
                                        <strong class="h5 text-primary">
                                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                        </strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                {{-- Alamat --}}
                <div class="px-4 py-3 bg-light border-top">
                    <h3 class="h6 fw-semibold mb-2">Alamat Pengiriman</h3>
                    <hr>
                    <address class="mb-0 text-muted">

                        
                        <strong class="text-dark">{{ $order->shipping_name }}</strong><br>
                        {{ $order->shipping_phone }}<br>
                        {{ $order->shipping_address }}
                    </address>
                </div>

                {{-- Debug Info (opsional, hapus di production) --}}
                {{-- <div class="alert alert-secondary m-4">
                    Status: {{ $order->status }} <br>
                    Snap Token: {{ $order->snap_token ? 'ADA' : 'KOSONG' }}
                </div> --}}

                {{-- Bayar --}}
                @if($order->status === 'pending' && $order->snap_token)
                <div class="p-4 text-center bg-brand-">
                    <p class="text-dark opacity-75 mb-3">
                        Selesaikan pembayaran untuk melanjutkan pesanan
                    </p>
                    <button id="pay-button" class="btn btn-light btn-lg px-5 fw-semibold shadow-sm">
                        <i class="bi bi-credit-card me-2"></i> Bayar Sekarang
                    </button>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

{{-- Snap.js --}}
@if($order->snap_token)
@push('scripts')
<script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const payButton = document.getElementById('pay-button');

    if (payButton) {
        payButton.addEventListener('click', function () {
            payButton.disabled = true;
            payButton.innerHTML = 'Memproses...';

            snap.pay('{{ $order->snap_token }}', {
                onSuccess: () => window.location.href = '{{ route("orders.success", $order) }}',
                onPending: () => window.location.href = '{{ route("orders.pending", $order) }}',
                onError: () => location.reload(),
                onClose: () => {
                    payButton.disabled = false;
                    payButton.innerHTML = 'Bayar Sekarang';
                }
            });
        });
    }
});
</script>
@endpush
@endif

@endsection