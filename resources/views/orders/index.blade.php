@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="h4 fw-semibold mb-4">Pesanan Saya</h1>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">

            @forelse($orders as $order)
            <div class="d-flex justify-content-between align-items-center px-4 py-3 border-bottom">

                {{-- Info Order --}}
                <div>
                    <div class="fw-semibold">
                        Order #{{ $order->order_number }}
                    </div>
                    <small class="text-muted">
                        {{ $order->created_at->format('d M Y, H:i') }}
                    </small>
                </div>

                <div class="">
                    {{ $order->image_url ? '<img src="' . $order->image_url . '" class="rounded" width="40">' : '' }}
                </div>

                {{-- Status --}}
                <div>
                    <span class="badge rounded-pill
                            @if($order->status === 'pending') bg-warning-subtle text-warning p-2 px-3
                            @elseif($order->status === 'processing') bg-info-subtle text-info p-2 px-3
                            @elseif($order->status === 'shipped') bg-primary-subtle text-primary p-2 px-3
                            @elseif($order->status === 'delivered') bg-success-subtle text-success p-2 px-3
                            @elseif($order->status === 'cancelled') bg-danger-subtle text-danger p-2 px-3
                            @else bg-secondary-subtle text-secondary
                            @endif
                        ">
                        @switch($order->status)
                        @case('pending') Pending @break
                        @case('processing') Diproses @break
                        @case('shipped') Dikirim @break
                        @case('delivered') Sampai Tujuan @break
                        @case('completed') Selesai @break
                        @case('cancelled') Batal @break
                        @default {{ ucfirst($order->status) }}
                        @endswitch
                    </span>
                </div>

                {{-- Total & Aksi --}}
                <div class="text-end">
                    <div class="fw-semibold">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </div>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-primary btn-sm text-decoration-none px-3 mt-1">
                        Lihat Detail →
                    </a>
                </div>
            </div>
            @empty
            <div class="text-center py-5 text-muted">
                Belum ada pesanan
            </div>
            @endforelse

        </div>

        {{-- Pagination --}}
        <div class="card-footer bg-white border-0">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection