<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pelanggan;
use App\Models\Pesanan;

class DetailPesanan extends Controller
{
    public function index($id)
    {
        $pelanggan = Pelanggan::with('pesanan')->findOrFail($id);
        $pesanan = Pesanan::with('menu')->where('pelanggan_id', $id)->get();
        return view('transaksi.detail', [
            'pelanggan' => $pelanggan,
            'pesanan' => $pesanan,
        ]);
    }
}
