<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\Transaksi;

class DetailPesanan extends Controller
{
    public function index($id)
    {
        if (Auth::user()->role == 'kasir') {
            $pelanggan = Pelanggan::with('pesanan')->findOrFail($id);
            $pesanan = Pesanan::with(['menu', 'transaksi'])->where('pelanggan_id', $id)->get();
            $transaksi = Transaksi::findOrFail($id);

            return view('transaksi.detail', [
                'pelanggan' => $pelanggan,
                'pesanan' => $pesanan,
                'transaksi' => $transaksi,
            ]);
        } else {
            return redirect()->back();
        }
    }
    public function bayar(Request $request, $id)
    {
        if (Auth::user()->role == 'kasir') {
            $item = Transaksi::find($id);
            $kembalian = (int) $item->total - (int) $request->bayar;

            $request->validate([
                'bayar' => 'required'
            ]);

            if ($item) {
                $item->bayar = abs($kembalian);
                $item->save();
            }
            // $data['bayar'] = abs($kembalian);

            return redirect()->route('transaksi');
        } else {
            return redirect()->back();
        }
       
    }
}
