<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'category_id'];

    // Relasi: satu produk dimiliki oleh satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: satu produk bisa muncul di banyak transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}

