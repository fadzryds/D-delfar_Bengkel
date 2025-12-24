<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;
use App\Models\CheckoutSparepart;
use App\Models\Customer;

class CartController extends Controller
{
    public function add(Request $request)
{
    $request->validate([
        'sparepart_id' => 'required|exists:spareparts,id',
        'quantity' => 'required|integer|min:1'
    ]);

    $sparepart = Sparepart::findOrFail($request->sparepart_id);

    $cart = session()->get('cart', []);

    // jika barang sudah ada di cart → tambah qty
    if (isset($cart[$sparepart->id])) {
        $cart[$sparepart->id]['quantity'] += $request->quantity;
    } else {
        $cart[$sparepart->id] = [
            'id' => $sparepart->id,
            'name' => $sparepart->name,
            'price' => $sparepart->price,
            'quantity' => $request->quantity,
            'image' => $sparepart->image,
        ];
    }

    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'Sparepart ditambahkan ke cart');
}

}
