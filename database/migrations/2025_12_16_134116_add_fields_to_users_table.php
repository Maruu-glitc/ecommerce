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

            // Menentukan role user (customer / admin)
            $table->enum('role', ['customer', 'admin'])
                ->default('customer')
                ->after('password');

            // Menyimpan avatar / foto profil user
            $table->string('avatar')
                ->nullable()
                ->after('role');

            // ID Google OAuth untuk login via Google
            $table->string('google_id')
                ->nullable()
                ->unique()
                ->after('avatar');

            // Nomor telepon user
            $table->string('phone', 20)
                ->nullable()
                ->after('google_id');

            // Alamat lengkap user
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
