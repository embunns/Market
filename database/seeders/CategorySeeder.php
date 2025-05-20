<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data kategori yang akan dimasukkan
        $categories = [
            ['name' => 'Elektronik', 'description' => 'Produk elektronik seperti TV, laptop, smartphone, dll'],
            ['name' => 'Pakaian', 'description' => 'Berbagai jenis pakaian pria dan wanita'],
            ['name' => 'Perabotan Rumah', 'description' => 'Furnitur dan perlengkapan rumah tangga'],
            ['name' => 'Makanan & Minuman', 'description' => 'Produk makanan dan minuman'],
            ['name' => 'Kesehatan & Kecantikan', 'description' => 'Produk perawatan kesehatan dan kecantikan'],
            ['name' => 'Olahraga', 'description' => 'Perlengkapan dan pakaian olahraga'],
            ['name' => 'Buku & Alat Tulis', 'description' => 'Buku, alat tulis, dan kebutuhan kantor'],
            ['name' => 'Otomotif', 'description' => 'Aksesoris dan perlengkapan otomotif'],
        ];

        // Insert data kategori ke database
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}