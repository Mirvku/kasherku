@section('title', 'Transaksi')

<div class="container">
    <h1 class="h3 mb-1">Transaksi</h1>
    <div class="row">
        <div class="card card-body shadow">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>Invoice</th>
                            <th>Nama</th>
                            <th>Total</th>
                            <th>Kasir</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center font-weight-bold ">

                        @forelse ($transaksi as $item)
                            <tr>
                                <td>{{ $item->invoice_number }}</td>
                                <td>{{ $item->pelanggan->nama_pelanggan }}</td>
                                <td>@rupiah($item->total)</td>
                                <td>{{ $item->user->name }}</td>
                                <td>
                                    <a href="{{ url('/dashboard/detail-transaksi/' . $item->id) }}"
                                        class="btn btn-primary my-2">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-info">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <form action="#" method="post" class="d-inline">
                                        <button class="btn btn-danger my-2">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <td colspan="5" class="text-center">Tidak ada pesanan</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
