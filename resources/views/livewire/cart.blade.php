@section('title', 'Pesan Makanan')
<div class="container">
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('sukses'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('sukses') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        {{-- Daftar Menu --}}
        <div class="col-md-8 mb-3">
            <div class="card shadow">
                <h5 class="card-header text-center">Daftar Menu</h5>
                <div class="card-body">
                    <input wire:model="search" type="text" class="form-control mb-3" placeholder="Search Menu...">
                    <div class="row">
                        @forelse ($products as $product)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <img wire:click="addItem({{ $product->id }})"
                                            src="{{ Storage::url($product->image) }}" alt="Menu"
                                            class="img-res rounded mb-2">
                                        <h6 class="card-title text-center mb-0">{{ $product->name }}
                                            ({{ $product->quantity }})
                                        </h6>
                                        <p class="card-title text-center">@rupiah($product->price)</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h5 class="text-center mt-3 fw-bold w-100">Tidak ada menu</h5>
                        @endforelse
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Form isi orderan --}}
        <div class="col-md-4">
            <div class="card shadow mb-2">
                <h5 class="card-header text-center">Data Pemesan</h5>
                <div class="card-body">
                    <form wire:submit.prevent="handleSubmit">
                        <div class="mb-2">
                            <label for="namaPelanggan" class="form-label" >Nama Pemesan</label>
                            <input wire:model="nama_pelanggan" type="text" class="form-control" id=nama-pemesan"
                                aria-describedby="emailHelp" required>
                        </div>
                        <div>
                            <label for="exampleInputPassword1" class="form-label">Nomor Bangku</label>
                            <input wire:model="no_bangku" type="number" class="form-control" id="nomor-bangku" required>
                        </div>
                </div>
            </div>
            <div class="card shadow">
                <h5 class="card-header text-center">Pesanan</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover">
                            <thead class="bg-secondary text-white ">
                                <tr class="text-center">
                                    {{-- <th class="fw-normal"></th> --}}
                                    <th class="fw-normal">No.</th>
                                    <th class="fw-normal">Name</th>
                                    <th class="fw-normal">Price</th>
                                    <th class="fw-normal">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cart as $carts)
                                    <tr class="text-center">
                                        {{-- <td>
                                            <a href="#" class="text-decoration-none fw-bold text-danger">Hapus</a>
                                        </td> --}}
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            {{ $carts['name'] }} ({{ $carts['quantity'] }})
                                        </td>
                                        <td width="30%">@rupiah($carts['price'])</td>
                                        <td width="30%">
                                            <span wire:click="increment('{{ $carts['rowId'] }}')"
                                                class="text-decoration-none font-weight-bold text-success"
                                                style="font-size: 20px; cursor: pointer;">+</span>
                                            <span wire:click="decrease('{{ $carts['rowId'] }}')"
                                                class="text-decoration-none font-weight-bold  text-warning"
                                                style="font-size: 20px; cursor: pointer;">-</span>
                                            <br>
                                            <span wire:click="remove('{{ $carts['rowId'] }}')"
                                                class="text-decoration-none font-weight-bold  text-danger"
                                                style="cursor: pointer;">remove</span>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="4" class="text-center font-weight-bold ">Pesanan Kosong</td>
                                @endforelse
                            </tbody>
                        </table>
                        <p class="font-weight-bold ">Total: <span class="text-success">@rupiah($total)</span>
                        </p>
                        <button type="submit" class="btn btn-success btn-sm w-100" id="simpan-bayar">
                            PESAN
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>