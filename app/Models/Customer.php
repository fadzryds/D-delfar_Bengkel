<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_id',
        'no_ktp',
        'alamat',
        'no_hp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kendaraans()
    {
        return $this->hasMany(Kendaraan::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function sparepartSales()
    {
        return $this->hasMany(SparepartSale::class);
    }

}
