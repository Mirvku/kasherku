<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaksi;
use App\Models\Menu;

use Dompdf\Dompdf;
use Dompdf\Options;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanBulananController extends Controller
{
    public function index()
    {
        $report = Menu::all();
        $total = $report->sum(function ($buyDetail) {
            return $buyDetail->price * $buyDetail->terjual;
        });


        // return view('Laporan.cetak', [
        //     'report' => $report,
        //     'total' => $total,
        // ]);


        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true,])->loadview('Laporan.cetak', [
            'report' => $report,
            'total' => $total,
        ]);

        return $pdf->setWarnings(false)->download('transaksi-0' . rand(1, 100) . '.pdf');
    }

    public function cetakLaporan($tglawal, $tglakhir)
    {
        // $transaksi = Transaksi::with(['pelanggan', 'pesanan'])->whereBetween('created_at', [$tglawal, $tglakhir])->get();

        // $menu = Menu::with('pesanan')->whereBetween('created_at', [$tglawal, $tglakhir])->get();

        // // return $transaksi;
        // return view('Laporan.cetak', [
        //     'transaksi' => $transaksi,
        //     'menu' => $menu
        // ]);
        // dd("Tanggal Awal: " . $tglawal, "Tanggal Akhir: " . $tglakhir);
    }
}
