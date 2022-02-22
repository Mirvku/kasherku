<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Transaksi as Transaction;

class Transaksi extends Component
{
    public function render()
    {
        $transaksi = Transaction::with(['pelanggan', 'pesanan', 'user'])->get();
        return view('livewire.pesanan', [
            'transaksi' => $transaksi,
        ])->extends('layouts.admin')
            ->section('content');
    }
}
