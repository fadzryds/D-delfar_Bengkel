<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $fillable = [
        'customer_id',
        'nomor_plat',
        'merk',
        'tipe',
        'tahun',
        'warna',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

}