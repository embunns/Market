<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Relasi: satu kategori bisa punya banyak produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
