<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\Transaksi;

use Barryvdh\DomPDF\Facade\Pdf;


class LaporanController extends Controller
{
    public function index($id)
    {
        $pelanggan = Pelanggan::with('pesanan')->findOrFail($id);
        $pesanan = Pesanan::with(['menu', 'transaksi'])->where('pelanggan_id', $id)->get();
        $transaksi = Transaksi::findOrFail($id);

        // return view('Laporan.index', [
        //     'pelanggan' => $pelanggan,
        //     'pesanan' => $pesanan,
        //     'transaksi' => $transaksi,
        // ]);

        $pdf = PDF::loadview('Laporan.index', [
            'pelanggan' => $pelanggan,
            'pesanan' => $pesanan,
            'transaksi' => $transaksi,
        ]);

        return $pdf->setWarnings(false)->download('transaksi-0' . rand(1, 100) . '.pdf');
        




        // $pdf = PDF::loadHTML('<h1>Test</h1>')->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf');
        // return $pdf;
    }
}
