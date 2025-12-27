@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="h3 mb-4 fw-bold">Daftar Pesanan Saya</h1>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No. Order</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td class="fw-bold text-primary">
                                #{{ $order->order_number }}
                            </td>

                            <td>
                                {{ $order->created_at->format('d M Y H:i') }}
                            </td>

                            <td>
                                <span class="badge
                                    @if($order->status === 'pending') bg-warning text-dark
                                    @elseif($order->status === 'processing') bg-info text-dark
                                    @elseif($order->status === 'shipped') bg-primary
                                    @elseif($order->status === 'delivered') bg-success
                                    @elseif($order->status === 'cancelled') bg-danger
                                    @else bg-secondary
                                    @endif
                                ">
                                    @switch($order->status)
                                    @case('pending') Pending @break
                                    @case('processing') Diproses @break
                                    @case('shipped') Dikirim @break
                                    @case('delivered') Sampai @break
                                    @case('cancelled') Batal @break
                                    @default {{ ucfirst($order->status) }}
                                    @endswitch
                                </span>
                            </td>

                            <td class="fw-bold">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </td>

                            <td class="text-end">
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                Belum ada pesanan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection