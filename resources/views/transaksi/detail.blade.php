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
                                <td>@rupiah($transaksi->total )</td>
                            </tr>
                            <tr>
                                <th>Pesanan</th>
                                <td>
                                    <table class="table table-bordered text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Menu</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                        </tr>
                                        @foreach ($pesanan as $item)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <th>{{ $item->menu->name }}</th>
                                                <th>@rupiah($item->menu->price)</th>
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
                    @if ($transaksi->bayar)
                     <h5 class="card-header text-center">Print Transaksi</h5>
                    @else
                     <h5 class="card-header text-center">Bayar</h5>
                    @endif
                    <div class="card-body">
                        @if ($transaksi->bayar)
                             <a  href="{{ url('/dashboard/laporan/'. $transaksi->id)}}" type="submit" class="btn btn-success btn-sm w-100" id="simpan-bayar">
                                Print
                            </a>
                        @else
                        <form action="{{ url('/dashboard/detail-transaksi/bayar/'. $transaksi->id) }}" method="POST">
                            @csrf

                            <div class="mb-2">
                                <label class="form-label">Bayar Pesanan</label>
                                <input type="number" class="form-control" id="bayar" name="bayar" placeholder="Input pembayaran">
                                <input type="hidden" value="{{ $transaksi->invoice_number  }}"  name="invoice_number">
                                <input type="hidden" value="{{ $transaksi->pesanan_id  }}"  name="pesanan_id">
                                <input type="hidden" value="{{ $transaksi->total  }}" id="total" name="total">
                                <input type="hidden" value="{{ $transaksi->pelanggan_id  }}"  name="pelanggan_id">
                                <input type="hidden" value="{{ $transaksi->user_id  }}"  name="user_id">
                            </div>

                            <p class="font-weight-bold ">Total: <span class="text-success">@rupiah($transaksi->total )</span>
                            </p>
                            <p class="font-weight-bold ">Kembalian: <span class="text-danger" id="kembalian">Rp.
                                    0
                                </span>
                            </p>
                            {{-- <a href="{{ url('/dashboard/laporan/'. $transaksi->id) }}" class="btn btn-success btn-sm w-100">
                                Bayar
                            </a> --}}
                            <button  type="submit" class="btn btn-success btn-sm w-100" id="simpan-bayar">
                                PESAN
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-tambahan')
    <script>
        bayar.oninput = () => {
            const totalPembayaran = document.getElementById('bayar').value;
            const totalBayar = document.getElementById('total').value;
            const totalKembalian = totalPembayaran - totalBayar;

            console.log(totalBayar);
            document.getElementById('kembalian').innerHTML = rupiah(totalKembalian);

            const saveButton = document.getElementById('simpan-bayar');

            if (totalKembalian < 0 || totalBayar <= 0) {
                saveButton.disabled = true;
            } else {
                saveButton.disabled = false;
            }
        }


        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number);
        }
    </script>
@endpush