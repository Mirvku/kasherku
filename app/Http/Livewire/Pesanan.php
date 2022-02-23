<?php

namespace App\Http\Livewire;

use DB;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Transaksi as Transaction;
use App\Models\Pesanan as MenuTransaction;
use App\Models\Menu as ProductModel;
use App\Models\Pelanggan;




class Pesanan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // public $tax = "0%";
    public $search;

    // public $bayar = 0;
    public $nama_pelanggan;
    public $no_bangku;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // public function handleSubmit()
    // {
    //     dd($this->bayar);
    // }

    public function render()
    {
        $product = ProductModel::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'asc')->paginate(4);

        // $condition = new \Darryldecode\Cart\CartCondition([
        //     'name' => 'pajak',
        //     'type' => 'tax',
        //     'target' => 'total',
        //     'value' => $this->tax,
        //     'order' => 1,
        // ])->condition($condition);

        \Cart::session(Auth()->id());
        $items = \Cart::session(Auth()->id())->getContent()->sortBy(function ($cart) {
            return $cart->attributes->get('added_at');
        });

        if (\Cart::isEmpty()) {
            $cartData = [];
        } else {
            foreach ($items as $item) {
                # code...
                $cart[] = [
                    'rowId' => $item->id,
                    'name' => $item->name,
                    'quantity' => $item->quantity,
                    'priceSingle' => $item->price,
                    'price' => $item->getPriceSum(),
                ];
            }

            $cartData = collect($cart);
        }

        // $sub_total = \Cart::session(Auth()->id())->getSubTotal();
        $total = \Cart::session(Auth()->id())->getTotal();

        // $newCondition = \Cart::session(Auth()->id())->getCondition('pajak');
        // $pajak = $newCondition->getCalculatedValue($sub_total);

        // $summary = [
        //     'total' => $total,
        // ];



        return view('livewire.cart', [
            'products' => $product,
            'cart' => $cartData,
            'total' => $total,
        ])->extends('layouts.admin')
            ->section('content');
    }

    public function addItem($id)
    {
        $menu = ProductModel::find($id);
        $rowId = 'Menu' . $id;
        $pesanan = \Cart::session(Auth()->id())->getContent();
        $cekPesanan = $pesanan->whereIn('id', $rowId);

        if ($cekPesanan->isNotEmpty()) {
            if ($menu->quantity == $cekPesanan[$rowId]->quantity) {
                session()->flash('error', 'Maaf tidak bisa menambah karena pesanan melebihi batas!');
            } else {
                \Cart::session(Auth()->id())->update($rowId, [
                    'quantity' => [
                        'relative' => false,
                        'value' => 1,
                    ],
                ]);
            }
        } else {
            if ($menu->quantity === 0) {
                session()->flash('error', 'Maaf tidak bisa menambah karena pesanan sudah habis!');
            } else {
                \Cart::session(Auth()->id())->add([
                    'id' => "Menu" . $id,
                    'name' => $menu->name,
                    'price' => $menu->price,
                    'quantity' => 1,
                    'attributes' => [
                        'added_at' => Carbon::now(),
                    ],
                ]);
            }
        }
    }

    public function increment($rowId)
    {
        $IdPesanan = substr($rowId, 4, 5);
        $menu = ProductModel::find($IdPesanan);

        $pesanan = \Cart::session(Auth()->id())->getContent();
        $cekPesanan = $pesanan->whereIn('id', $rowId);

        if ($menu->quantity == $cekPesanan[$rowId]->quantity) {
            session()->flash('error', 'Maaf tidak bisa menambah karena pesanan melebihi batas!');
        } else {
            if ($menu->quantity === 0) {
                session()->flash('error', 'Maaf tidak bisa menambah karena pesanan sudah habis!');
            } else {
                \Cart::session(Auth()->id())->update($rowId, [
                    'quantity' => [
                        'relative' => true,
                        'value' => 1,
                    ],
                ]);
            }
        }
    }

    public function decrease($rowId)
    {
        $pesanan = \Cart::session(Auth()->id())->getContent();

        $cekPesanan = $pesanan->whereIn('id', $rowId);

        if ($cekPesanan[$rowId]->quantity > 1) {
            \Cart::session(Auth()->id())->update($rowId, [
                'quantity' => [
                    'relative' => true,
                    'value' => -1,
                ],
            ]);
        } else {
            \Cart::session(Auth()->id())->remove($rowId);
        }
    }

    public function remove($rowId)
    {
        \Cart::session(Auth()->id())->remove($rowId);
    }

    public function handleSubmit()
    {
        $cartTotal = \Cart::session(Auth()->id())->getTotal();
        // $payment = $this->bayar;
        // $kembalian = (int) $payment - (int) $cartTotal;

        DB::beginTransaction();

            try {
                $allCart = \Cart::session(Auth()->id())->getContent();

                $filterCart = $allCart->map(function ($item) {
                    return [
                        'id' => substr($item->id, 4, 5),
                        'quantity' => $item->quantity,
                    ];
                });

            

                foreach ($filterCart as $cart) {
                    $product = ProductModel::find($cart['id']);

                    if ($product->quantity === 0) {
                        session()->flash('error', 'Jumlah MENU kurang');
                    }

                    $product->decrement('quantity', $cart['quantity']);
                $product->increment('terjual', $cart['quantity']);
                }

                foreach ($filterCart as $doubt) {
                    $product = ProductModel::find($doubt['id']);
                }
           


                $id = IdGenerator::generate(
                    [
                        'table'  => 'pesanan',
                        'length' => 10,
                        'prefix' => 'INV-',
                        'field'  => 'invoice_number',
                    ]
                );

                $pelanggan = Pelanggan::create([
                    'nama_pelanggan' => $this->nama_pelanggan,
                    'no_bangku' => $this->no_bangku,
                ]);

                foreach ($filterCart as $cart) {
                    MenuTransaction::create([
                        'menu_id' => $cart['id'],
                        'pelanggan_id' =>  $pelanggan->id,
                        'invoice_number' => $id,
                        'jumlah' => $cart['quantity'],
                    'kasir' => Auth::user()->name,
                    ]);
                }

                Transaction::create([
                    'invoice_number' => $id,
                    'pesanan_id' => $cart['id'],
                'total' => $cartTotal,
                    'pelanggan_id' =>  $pelanggan->id,
                'kasir' => Auth::user()->name,
                ]);



                \Cart::session(Auth()->id())->clear();
                $this->payment = 0;
                $this->nama_pelanggan = '';
                $this->no_bangku = '    ';
                session()->flash('sukses', 'Yow, berhasil memesan!');

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                return session()->flash('error', $th);
            }
        
    }
}
