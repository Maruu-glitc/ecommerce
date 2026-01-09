<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\User;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Wishlist;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Observer Produk
        Product::observe(ProductObserver::class);

        // Pagination Bootstrap 5
        Paginator::useBootstrapFive();

        // 🔥 SHARE DATA CART KE SEMUA VIEW
        View::composer('*', function ($view) {
            if (auth()->check() && auth()->user()->cart) {

                $cart = auth()->user()->cart->load('items.product');

                $totalQty = $cart->items->sum('quantity');

                $totalPrice = $cart->items->sum(function ($item) {
                    return $item->product->price * $item->quantity;
                });

                // ❤️ WISHLIST
                $wishlistCount = auth()->user()->wishlists()->count();

                $view->with([
                    'cart' => $cart,
                    'totalQty' => $totalQty,
                    'totalPrice' => $totalPrice,
                ]);

                // ===== WISHLIST =====
                $wishlistCount = Wishlist::where('user_id', auth()->id())->count();

                $view->with('wishlistCount', $wishlistCount);
            }
        });
    }
}
