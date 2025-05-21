<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pastikan ada customer dan produk terlebih dahulu
        $customerCount = Customer::count();
        $productCount = Product::count();
        
        if ($customerCount == 0) {
            // Jalankan CustomerSeeder jika belum ada customer
            $this->call(CustomerSeeder::class);
        }
        
        if ($productCount == 0) {
            // Jalankan ProductSeeder jika belum ada produk
            $this->call(ProductSeeder::class);
        }
        
        // Dapatkan semua customer dan produk
        $customers = Customer::all();
        $products = Product::all();

        // Jika tidak ada customer atau produk, keluar dari seeder
        if ($customers->isEmpty() || $products->isEmpty()) {
            return;
        }

        $faker = Faker::create('id_ID');
        
        // Buat data transaksi untuk 3 bulan terakhir
        $startDate = Carbon::now()->subMonths(3);
        $endDate = Carbon::now();
        
        // Buat 50 transaksi acak
        for ($i = 0; $i < 50; $i++) {
            // Pilih customer dan produk acak
            $customer = $customers->random();
            $product = $products->random();
            
            // Buat tanggal transaksi acak dari 3 bulan yang lalu hingga sekarang
            $transactionDate = $faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d');
            
            // Buat total harga - ambil harga produk sebagai default, kadang dengan sedikit variasi
            $priceVariation = rand(0, 1) ? 1 : rand(90, 110) / 100; // Kadang harga tetap, kadang dengan variasi +/- 10%
            $totalPrice = round($product->price * $priceVariation);
            
            // Buat transaksi
            Transaction::create([
                'customer_id' => $customer->id,
                'product_id' => $product->id,
                'total_price' => $totalPrice,
                'transaction_date' => $transactionDate,
            ]);
        }
        
        // Buat transaksi khusus untuk customer tetap (agar ada data yang konsisten)
        $johnDoe = Customer::where('email', 'john@example.com')->first();
        $janeSmith = Customer::where('email', 'jane@example.com')->first();
        
        if ($johnDoe) {
            // John membeli laptop
            $laptop = Product::where('name', 'like', '%Laptop%')->first();
            if ($laptop) {
                Transaction::create([
                    'customer_id' => $johnDoe->id,
                    'product_id' => $laptop->id,
                    'total_price' => $laptop->price,
                    'transaction_date' => Carbon::now()->subDays(5)->format('Y-m-d'),
                ]);
            }
            
            // John juga membeli smartphone
            $smartphone = Product::where('name', 'like', '%Smartphone%')->first();
            if ($smartphone) {
                Transaction::create([
                    'customer_id' => $johnDoe->id,
                    'product_id' => $smartphone->id,
                    'total_price' => $smartphone->price,
                    'transaction_date' => Carbon::now()->subDays(3)->format('Y-m-d'),
                ]);
            }
        }
        
        if ($janeSmith) {
            // Jane membeli dress
            $dress = Product::where('name', 'like', '%Dress%')->first();
            if ($dress) {
                Transaction::create([
                    'customer_id' => $janeSmith->id,
                    'product_id' => $dress->id,
                    'total_price' => $dress->price,
                    'transaction_date' => Carbon::now()->subDays(7)->format('Y-m-d'),
                ]);
            }
            
            // Jane juga membeli paket skincare
            $skincare = Product::where('name', 'like', '%Skincare%')->first();
            if ($skincare) {
                Transaction::create([
                    'customer_id' => $janeSmith->id,
                    'product_id' => $skincare->id,
                    'total_price' => $skincare->price,
                    'transaction_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
                ]);
            }
        }
    }
}