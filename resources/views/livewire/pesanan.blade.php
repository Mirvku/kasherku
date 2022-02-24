@section('title', 'Transaksi')

<div class="container">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
            @if (Auth::user()->role == 'owner')
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fa-solid fa-plus fa-sm text-white-50"></i> Generate Laporan
                </a>
            @endif
        </div>
    <div class="row">
        <div class="card card-body shadow">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>Invoice</th>
                            <th>Nama</th>
                            <th>Total</th>
                            <th>Waiter</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center font-weight-bold ">

                        @forelse ($transaksi as $item)
                            <tr>
                                <td>{{ $item->invoice_number }}</td>
                                <td>{{ $item->pelanggan->nama_pelanggan }}</td>
                                <td>@rupiah($item->total)</td>
                                <td>{{ $item->kasir }}</td>
                                @if ($item->bayar)
                                    <td class="text-success">Sudah Bayar</td>
                                @else
                                    <td class="text-danger">Belum Bayar</td>
                                @endif
                                <td>
                                    <a href="{{ url('/dashboard/detail-transaksi/' . $item->id) }}"
                                        class="btn btn-primary my-2">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    {{-- <a href="#" class="btn btn-info">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <form action="#" method="post" class="d-inline">
                                        <button class="btn btn-danger my-2">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form> --}}
                                </td>
                            </tr>
                        @empty
                            <td colspan="6" class="text-center">Tidak ada pesanan</td>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                        {{ $transaksi->links() }}
                    </div>
            </div>
        </div>
    </div>
</div>
