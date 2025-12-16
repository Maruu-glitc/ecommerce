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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['customer', 'admin'])
                    ->default('customer')
                    ->after('password');

            // avatar user
            $table->string('avatar')->nullable()->after('role');

            // id dari google OAuth (untuk login dengan google)
            $table->string('google_id')
                    ->nullable()
                    ->unique()
                    ->after('avatar');

            // Untuk no telepon user
            $table->string('phone', 20)
                    ->nullable()
                    ->after('google_id');

            // untuk alamat user
            $table->text('address')
                    ->nullable()
                    ->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'avatar', 'google_id', 'phone', 'address']);
        });
    }
};
