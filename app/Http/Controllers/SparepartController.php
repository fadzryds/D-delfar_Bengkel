<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    public function landing()
    {
        $spareparts = Sparepart::all();
        return view('LandingPage', compact('spareparts'));
    }

    public function index()
    {
        $spareparts = Sparepart::all();
        return view('landing.Sparepart', compact('spareparts'));
    }

    public function show($id)
    {
        $sparepart = Sparepart::findOrFail($id);
        $otherSpareparts = Sparepart::where('id', '!=', $id)->get();

        return view('landing.OrderSparepart', compact('sparepart', 'otherSpareparts'));
    }
}