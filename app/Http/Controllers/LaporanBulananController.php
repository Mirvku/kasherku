<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanBulananController extends Controller
{
    public function index()
    {
        return view('Laporan.bulanan');
    }

    public function cetakLaporan($tglawal, $tglakhir)
    {
        dd("Tanggal Awal: " . $tglawal, "Tanggal Akhir: " . $tglakhir);
    }
}
