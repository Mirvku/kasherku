<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\Transaksi;

class DetailPesanan extends Controller
{
    public function index($id)
    {
        $pelanggan = Pelanggan::with('pesanan')->findOrFail($id);
        $pesanan = Pesanan::with(['menu', 'transaksi'])->where('pelanggan_id', $id)->get();
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.detail', [
            'pelanggan' => $pelanggan,
            'pesanan' => $pesanan,
            'transaksi' => $transaksi,
        ]);
    }
}
