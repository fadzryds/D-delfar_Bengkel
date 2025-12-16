<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SparepartSale extends Model
{
    protected $fillable = ['customer_id', 'sparepart_id', 'quantity', 'total_price'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class);
    }
}