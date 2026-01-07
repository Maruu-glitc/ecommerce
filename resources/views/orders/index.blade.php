@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="h4 fw-semibold mb-4">Pesanan Saya</h1>
    <a href="/"></a>
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0 table-responsive">

            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Order</th>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Status Bayar</th>
                        <th>Status Pesanan</th>
                        <th class="text-end">Total</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody class="m-3">
                    @forelse($orders as $order)
                    <tr>
                        {{-- Order Number --}}
                        <td class="fw-semibold">
                            #{{ $order->order_number }}
                        </td>

                        {{-- Tanggal --}}
                        <td class="text-muted">
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </td>

                        {{-- Produk / Thumbnail --}}
                        <td>
                            @if($order->image_url)
                                <img src="{{ $order->image_url }}" class="rounded" width="70">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        {{-- Payment Status --}}
                        <td>
                            <span class="badge rounded-pill
                                @if($order->payment_status === 'pending') bg-warning-subtle text-warning
                                @elseif($order->payment_status === 'paid') bg-success-subtle text-success
                                @elseif($order->payment_status === 'unpaid') bg-danger-subtle text-danger
                                @else bg-secondary-subtle text-secondary
                                @endif
                                px-3 py-2">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>

                        {{-- Order Status --}}
                        <td>
                            <span class="badge rounded-pill
                                @if($order->status === 'pending') bg-warning-subtle text-warning
                                @elseif($order->status === 'processing') bg-info-subtle text-info
                                @elseif($order->status === 'shipped') bg-primary-subtle text-primary
                                @elseif($order->status === 'delivered') bg-success-subtle text-success
                                @elseif($order->status === 'cancelled') bg-danger-subtle text-danger
                                @else bg-secondary-subtle text-secondary
                                @endif
                                px-3 py-2">
                                @switch($order->status)
                                    @case('pending') Pending @break
                                    @case('processing') Diproses @break
                                    @case('shipped') Dikirim @break
                                    @case('delivered') Sampai @break
                                    @case('completed') Selesai @break
                                    @case('cancelled') Batal @break
                                    @default {{ ucfirst($order->status) }}
                                @endswitch
                            </span>
                        </td>

                        {{-- Total --}}
                        <td class="text-end fw-semibold">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </td>

                        {{-- Aksi --}}
                        <td class="text-end">
                            <a href="{{ route('orders.show', $order) }}"
                               class="btn btn-outline-primary btn-sm px-3">
                                Detail →
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            Belum ada pesanan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        {{-- Pagination --}}
        <div class="card-footer bg-white border-0">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
