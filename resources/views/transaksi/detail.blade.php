@extends('layouts.admin')
@section('title', 'Detail Pesanan')

@section('content')
    <div class="container">
        <h1 class="h3 mb-1 text-gray-800">Detail Transaksi {{$pelanggan->nama_pelanggan}}</h1>

        <div class="row">

            {{-- Detail Transaksi --}}
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-hovered table-bordered table-responsive">
                            <tr>
                                <th>Invoice</th>
                                <td>{{ $pelanggan->pesanan->invoice_number }}</td>
                            </tr>
                            <tr>
                                <th>Nama Pemesan</th>
                                <td>{{ $pelanggan->nama_pelanggan }}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>{{ $transaksi->total }}</td>
                            </tr>
                            <tr>
                                <th>Pesanan</th>
                                <td>
                                    <table class="table table-bordered text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Menu</th>
                                            <th>Harga</th>
                                            <th>Banyak</th>
                                        </tr>
                                        @foreach ($pesanan as $item)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <th>{{ $item->menu->name }}</th>
                                                <th>{{ $item->menu->price }}</th>
                                                <th>{{ $item->jumlah }}</th>
                                            </tr>
                                        @endforeach
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Print Struk --}}
            <div class="col-md-4">
                <div class="card mb-2 shadow">
                    <h5 class="card-header text-center">Print Struk</h5>
                    <div class="card-body">
                        <button class="btn btn-success btn-sm w-100" id="print">
                            PRINT
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection