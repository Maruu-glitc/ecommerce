<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/sapa/{nama}', function ($nama) {

    return "Halo, Selamat datang $nama di website kami!";

});

Route::get('/kategori/{nama?}', function ($nama = 'Semua') {
    return "Tampilkan Kategori: $nama";
});

// ================================================
// ROUTE DENGAN NAMA (NAMED ROUTE)
// ================================================
Route::get('produk/{id}', function ($id) {
    return "Tampilkan Produk: #$id";
})->name('produk.detail');