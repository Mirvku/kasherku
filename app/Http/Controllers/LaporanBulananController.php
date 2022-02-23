<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaksi;
use App\Models\Menu;

class LaporanBulananController extends Controller
{
    public function index()
    {
        return view('Laporan.bulanan');
    }

    public function cetakLaporan($tglawal, $tglakhir)
    {
        $transaksi = Transaksi::with(['pelanggan', 'pesanan'])->whereBetween('created_at', [$tglawal, $tglakhir])->get();

        $menu = Menu::with('pesanan')->whereBetween('created_at', [$tglawal, $tglakhir])->get();

        // return $transaksi;
        return view('Laporan.cetak', [
            'transaksi' => $transaksi,
            'menu' => $menu
        ]);
        // dd("Tanggal Awal: " . $tglawal, "Tanggal Akhir: " . $tglakhir);
    }
}
