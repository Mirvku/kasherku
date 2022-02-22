<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Transaksi extends Model
{
    use HasFactory;
    protected $table      = 'transaksi';
    // protected $primaryKey = 'invoice_number'; // untuk memberi tahu model, nama primary keynya
    // public $incrementing  = false;  // untuk memberi tahu model, kalau increment sudah di lakukan di ID Generator
    // protected $keyType    =  'string'; // untuk memberi tahu model, kalau jenis primaryKeynya itu adalah STRING

    protected $guarded = ['id'];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
