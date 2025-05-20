<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pastikan ada kategori sebelum membuat produk
        $categoryCount = Category::count();
        
        if ($categoryCount == 0) {
            // Jalankan CategorySeeder jika belum ada kategori
            $this->call(CategorySeeder::class);
        }
        
        // Data produk yang akan dimasukkan berdasarkan kategori
        $products = [
            // Elektronik
            [
                'name' => 'Laptop Asus ROG',
                'description' => 'Laptop gaming dengan performa tinggi',
                'price' => 15000000,
                'category_id' => 1,
            ],
            [
                'name' => 'Smartphone Samsung Galaxy S23',
                'description' => 'Smartphone dengan kamera berkualitas',
                'price' => 12000000,
                'category_id' => 1,
            ],
            [
                'name' => 'Smart TV 55 inch',
                'description' => 'Smart TV dengan resolusi 4K',
                'price' => 8000000,
                'category_id' => 1,
            ],
            
            // Pakaian
            [
                'name' => 'Kemeja Formal Pria',
                'description' => 'Kemeja formal untuk pria dengan bahan premium',
                'price' => 350000,
                'category_id' => 2,
            ],
            [
                'name' => 'Dress Wanita',
                'description' => 'Dress casual elegan untuk wanita',
                'price' => 450000,
                'category_id' => 2,
            ],
            
            // Perabotan Rumah
            [
                'name' => 'Sofa 3 Seater',
                'description' => 'Sofa nyaman untuk ruang tamu',
                'price' => 5000000,
                'category_id' => 3,
            ],
            [
                'name' => 'Meja Makan Set',
                'description' => 'Set meja makan dengan 6 kursi',
                'price' => 3500000,
                'category_id' => 3,
            ],
            
            // Makanan & Minuman
            [
                'name' => 'Paket Sembako',
                'description' => 'Paket sembako lengkap untuk kebutuhan bulanan',
                'price' => 500000,
                'category_id' => 4,
            ],
            [
                'name' => 'Coffee Beans Premium',
                'description' => 'Biji kopi arabika premium 1kg',
                'price' => 250000,
                'category_id' => 4,
            ],
            
            // Kesehatan & Kecantikan
            [
                'name' => 'Paket Skincare',
                'description' => 'Paket lengkap perawatan wajah',
                'price' => 750000,
                'category_id' => 5,
            ],
            [
                'name' => 'Vitamin C',
                'description' => 'Suplemen vitamin C untuk daya tahan tubuh',
                'price' => 85000,
                'category_id' => 5,
            ],
            
            // Olahraga
            [
                'name' => 'Sepatu Lari',
                'description' => 'Sepatu lari berkualitas tinggi',
                'price' => 1200000,
                'category_id' => 6,
            ],
            [
                'name' => 'Raket Badminton',
                'description' => 'Raket badminton profesional',
                'price' => 850000,
                'category_id' => 6,
            ],
            
            // Buku & Alat Tulis
            [
                'name' => 'Novel Bestseller',
                'description' => 'Novel terlaris tahun 2023',
                'price' => 125000,
                'category_id' => 7,
            ],
            [
                'name' => 'Set Alat Tulis',
                'description' => 'Set alat tulis lengkap untuk kantor',
                'price' => 200000,
                'category_id' => 7,
            ],
            
            // Otomotif
            [
                'name' => 'Helm Full Face',
                'description' => 'Helm full face dengan standar keamanan tinggi',
                'price' => 1500000,
                'category_id' => 8,
            ],
            [
                'name' => 'Aksesoris Motor',
                'description' => 'Paket aksesoris motor lengkap',
                'price' => 750000,
                'category_id' => 8,
            ],
        ];

        // Insert data produk ke database
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}