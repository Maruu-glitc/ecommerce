<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Wishlist;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Observer Produk
        Product::observe(ProductObserver::class);

        // Pagination Bootstrap 5
        Paginator::useBootstrapFive();

        // ================= GLOBAL VIEW DATA =================
        View::composer('*', function ($view) {

            // Default aman (guest)
            $cart = null;
            $totalQty = 0;
            $totalPrice = 0;
            $wishlistCount = 0;

            if (auth()->check()) {

                // CART
                $cart = auth()->user()
                    ->cart()
                    ->with('items.product')
                    ->first();

                if ($cart) {
                    $totalQty = $cart->items->sum('quantity');

                    $totalPrice = $cart->items->sum('subtotal');
                }

                // WISHLIST
                $wishlistCount = Wishlist::where('user_id', auth()->id())->count();
            }

            $view->with(compact(
                'cart',
                'totalQty',
                'totalPrice',
                'wishlistCount'
            ));
        });
    }
}
