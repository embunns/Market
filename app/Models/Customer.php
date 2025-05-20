<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'address'];

    // Relasi: satu customer bisa melakukan banyak transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
