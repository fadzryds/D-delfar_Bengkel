<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckoutSparepart;
use App\Models\Sparepart;
use App\Models\Customer;

class CheckoutSparepartController extends Controller
{
    /**
     * Halaman Checkout (menampilkan isi cart)
     */
    public function index()
    {
        $cart = session('cart', []);

        return view('landing.CheckoutSparepart', compact('cart'));
    }

    /**
     * Proses simpan checkout ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'no_hp'          => 'required',
            'alamat'         => 'required',
            'pembayaran'     => 'required',
            'items'          => 'required|array',
        ]);

        // Ambil customer berdasarkan user login
        $customer = Customer::where('user_id', auth()->id())->first();

        if (!$customer) {
            return back()->with('error', 'Customer tidak ditemukan');
        }

        // Generate nomor pembelian
        $kode = CheckoutSparepart::generateQueueNumber();

        foreach ($request->items as $jsonItem) {
            $item = json_decode($jsonItem, true);

            CheckoutSparepart::create([
                'customer_id'     => $customer->id, // ✅ FIX FOREIGN KEY
                'sparepart_id'    => $item['id'],
                'nama_pelanggan'  => $request->nama_pelanggan,
                'no_hp'           => $request->no_hp,
                'harga_satuan'    => $item['price'],
                'quantity'        => $item['quantity'],
                'total_price'     => $item['price'] * $item['quantity'],
                'nomor_pembelian' => $kode,
                'pembayaran'      => $request->pembayaran,
                'status'          => 'Dipesan',
            ]);
        }

        // Kosongkan cart setelah checkout
        session()->forget('cart');

        return redirect()->route('sparepart')
            ->with('success', 'Checkout berhasil diproses');
    }

    /**
     * Halaman Konfirmasi Checkout
     */
    public function confirm()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('checkout.sparepart')
                ->with('error', 'Keranjang masih kosong');
        }

        $totalQty = 0;
        $totalPrice = 0;

        foreach ($cart as $item) {
            $totalQty += $item['quantity'];
            $totalPrice += $item['quantity'] * $item['price'];
        }

        return view('landing.ConfirmSparepart', [
            'cart'       => $cart,
            'totalQty'   => $totalQty,
            'totalPrice' => $totalPrice,
        ]);
    }
}
