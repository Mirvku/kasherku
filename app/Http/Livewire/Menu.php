<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


use App\Models\Menu as MenuMakanan;


use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Menu extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name, $image, $deskripsi, $quantity, $price;

    public function render()
    {
        $product = MenuMakanan::orderBy('created_at', 'asc')->paginate(4);
        return view('livewire.product', [
            'products' => MenuMakanan::orderBy('created_at', 'asc')->paginate(4),
        ])->extends('layouts.admin')
        ->section('content');
    }

    // public function previewImage()
    // {
    //     $this->validate([
    //         'image' => 'image|max:2048',
    //     ]);
    // }

    public function store(Request $request)
    {
        $this->validate([
            'name' => 'required',
            'image' => 'required|image|max:5000',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
        ]);

        $gambar = $this->image->store(
            'assets/public',
            'public'
        );

        MenuMakanan::create([
            'name' => $this->name,
            'image' => $gambar,
            'deskripsi' => $this->deskripsi,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]);

        session()->flash('info', 'Berhasil Menambah Menu Makanan!');

        $this->name = '';
        $this->image = '';
        $this->deskripsi = '';
        $this->quantity = '';
        $this->price = '';
    }

    public function delete($id)
    {



        if (Auth::user()->role == 'administrator') {
            $product = MenuMakanan::findOrFail($id);
            $product->delete();

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
