<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Transaksi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = Menu::all();
        $total = Transaksi::sum('total');
        $transactions = Transaksi::all()->count();

        return view('home', [
            'menus' => $product,
            'total' => $total,
            'transactions' => $transactions,
        ]);
    }
}
