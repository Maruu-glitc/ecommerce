<?php
// app/Services/OrderService.php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderService
{
    /**
     * Membuat Order baru dari Keranjang belanja.
     *
     * ALUR PROSES (TRANSACTION):
     * 1. Hitung total & Validasi Stok terakhir
     * 2. Buat Record Order (Header)
     * 3. Pindahkan Cart Items ke Order Items (Detail)
     * 4. Kurangi Stok Produk (Atomic Decrement)
     * 5. Hapus Keranjang
     */
    public function createOrder(User $user, array $shippingData): Order
    {
        $cart = $user->cart;

        if (!$cart || $cart->items->isEmpty()) {
            throw new \Exception("Keranjang belanja kosong.");
        }

        return DB::transaction(function () use ($user, $cart, $shippingData) {

            $totalAmount = 0;

            // A. VALIDASI STOK & HITUNG TOTAL
            foreach ($cart->items as $item) {
                $product = $item->product;

                if ($item->quantity > $product->stock) {
                    throw new \Exception("Stok produk {$product->name} tidak mencukupi.");
                }

                $finalPrice = $product->has_discount
                    ? $product->price - ($product->price * $product->discount_percentage / 100)
                    : $product->price;

                $totalAmount += $finalPrice * $item->quantity;
            }

            // B. BUAT ORDER
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'shipping_name' => $shippingData['name'],
                'shipping_address' => $shippingData['address'],
                'shipping_phone' => $shippingData['phone'],
                'total_amount' => $totalAmount,
            ]);

            // C. PINDAHKAN ITEMS
            foreach ($cart->items as $item) {
                $product = $item->product;

                $finalPrice = $product->has_discount
                    ? $product->price - ($product->price * $product->discount_percentage / 100)
                    : $product->price;

                $order->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,

                    // snapshot harga
                    'price' => $product->price,
                    'discount_price' => $product->has_discount ? $finalPrice : null,

                    'quantity' => $item->quantity,
                    'subtotal' => $finalPrice * $item->quantity,
                ]);

                // D. KURANGI STOK
                $product->decrement('stock', $item->quantity);
            }

            // E. BERSIHKAN KERANJANG
            $cart->items()->delete();

            return $order;
        });
    }
}
