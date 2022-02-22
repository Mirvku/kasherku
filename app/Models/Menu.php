<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $guarded = ['id'];

    use HasFactory;

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}
