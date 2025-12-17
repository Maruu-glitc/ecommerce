<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {

            // Primary key auto-increment
            $table->id();

            // Nama kategori (maksimal 100 karakter)
            $table->string('name', 100);

            // Slug kategori untuk URL (harus unik)
            $table->string('slug', 100)->unique();

            // Deskripsi kategori (opsional)
            $table->text('description')->nullable();

            // Path gambar kategori (opsional)
            $table->string('image')->nullable();

            // Status kategori (aktif / nonaktif)
            $table->boolean('is_active')->default(true);

            // Waktu pembuatan & update data
            $table->timestamps();

            // Index untuk optimasi query berdasarkan status
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
