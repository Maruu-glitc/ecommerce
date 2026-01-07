<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'payment_status',
        'shipping_name',
        'shipping_address',
        'shipping_phone',
        'total_amount',
        'shipping_cost',
        'snap_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // public function primaryProductImage(): HasOne
    // {
    //     return $this->hasOne(ProductImage::class)->where('is_primary', true);
    // }

    // App\Models\Order.php
    public function getImageUrlAttribute()
    {
        $item = $this->items->first();

        if (!$item || !$item->product || !$item->product->primaryImage) {
            return null;
        }

        return asset('storage/' . $item->product->primaryImage->image_path);
    }



    public function primaryProductImage()
    {
        return $this->hasOneThrough(
            ProductImage::class,
            OrderItem::class,
            'order_id',     // FK di order_items
            'product_id',   // FK di product_images
            'id',           // PK di orders
            'product_id'    // FK di order_items
        )->where('is_primary', true);
    }
}
