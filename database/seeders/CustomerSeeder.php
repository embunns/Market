<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Membuat 20 data customer dummy
        for ($i = 0; $i < 20; $i++) {
            Customer::firstOrCreate(
                ['email' => $faker->unique()->safeEmail],
                [
                    'name' => $faker->name,
                    'phone' => $faker->phoneNumber,
                    'address' => $faker->address,
                ]
            );
        }

        // Menambahkan beberapa customer tetap untuk testing
        Customer::firstOrCreate(
            ['email' => 'john@example.com'],
            [
                'name' => 'John Doe',
                'phone' => '081234567890',
                'address' => 'Jl. Testing No. 123, Jakarta Selatan',
            ]
        );
        
        Customer::firstOrCreate(
            ['email' => 'jane@example.com'],
            [
                'name' => 'Jane Smith',
                'phone' => '089876543210',
                'address' => 'Jl. Sample No. 456, Jakarta Utara',
            ]
        );
    }
}