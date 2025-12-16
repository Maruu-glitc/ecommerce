<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use function Symfony\Component\Clock\now;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Starting database seedeng...');
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
        $this->command->info('✅ Admin user created: admin@example.com');

        // 2. Buat beberapa customer
        User::factory(10)->create(['role' => 'customer']);
        $this->command->info('✅ 10 customer users created');

        // 3. Seed categories
        $this->call(CategorySeeder::class);

        // 4. Buat produk
        Product::factory(50)->create();
        $this->command->info('✅ 50 products created');

        // 5. Buat beberapa produk featured
        Product::factory(8)->featured()->create();
        $this->command->info('✅ 8 featured products created');

        $this->command->newLine();
        $this->command->info('Database seedeng baerhasil');
        $this->command->info('Admin login: admin@example.com / password');
    }
}
