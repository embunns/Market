<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // Hapus user jika sudah ada
    \App\Models\User::where('email', 'test@example.com')->delete();

    // Buat user baru
    \App\Models\User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);

    // Seeder lainnya
    $this->call([
        ProductSeeder::class,
        CategorySeeder::class,
        CustomerSeeder::class,
    ]);
}

}
