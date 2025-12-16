<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index($customerId)
    {
        $customer = Customer::with(['invoices', 'sparepartSales.sparepart'])->findOrFail($customerId);

        // Riwayat terakhir service / ganti oli
        $lastService = $customer->invoices()->orderByDesc('tanggal_servis')->first();

        // Riwayat terakhir beli sparepart
        $lastPurchase = $customer->sparepartSales()->orderByDesc('created_at')->first();

        return view('customer.history', compact('customer', 'lastService', 'lastPurchase'));
    }
}
