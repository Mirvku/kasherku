@section('title', 'Daftar Menu')

<div class="container">
    <div class="row">

        {{-- Daftar menu --}}
        <div class="col-md-8 mb-4">
            <div class="card shadow">
                <h5 class="card-header text-center font-weight-bold">Daftar Menu</h5>
                <div class="card-body">
                    <div class="row">
                        @forelse ($products as $product)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="{{ Storage::url($product->image) }}" alt="product"
                                        class="img-res card-img-top rounded">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">
                                            {{ $product->deskripsi }}
                                        </p>
                                        <a href="{{ url('/dashboard/menu/edit/' . $product->id) }}"
                                            class="btn btn-success btn-sm w-100 mb-2">
                                            Edit
                                        </a>
                                        {{-- <a href="{" class="btn btn-success btn-sm w-100 mb-2">Edit</a> --}}
                                        <a href="#" class="btn btn-danger btn-sm w-100">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h5 class="my-3 text-center w-100">Menu Kosong</h5>
                        @endforelse
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Tambah Menu --}}
        <div class="col-md-4">
            <div class="card shadow">
                <h5 class="card-header text-center font-weight-bold">Tambah Menu</h5>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        @csrf
                        <div class="form-group">
                            <label for="menuName" class="form-label">Nama Menu</label>
                            <input wire:model="name" type="text" class="form-control">
                            @error('name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="menuImage" class="form-label">Foto Menu</label>
                            <div class="input-group mb-3">
                                <input wire:model="image" type="file" class="form-control-file" id="inputGroupFile02">
                            </div>
                            @error('image')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                            @if ($image)
                                <label class="mt-2">Image preview</label>
                                <img src="{{ $image->temporaryUrl() }}" class="img-fluid" alt="Preview">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">Jumlah</label>
                            <input wire:model="quantity" type="number" class="form-control">
                            @error('quantity')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">Harga</label>
                            <input wire:model="price" type="text" class="form-control">
                            @error('price')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </form>
                </div>
            </div>
            {{-- <div class="card mt-3">
                <div class="card-body">
                    <h3>{{ $name }}</h3>
                    <h3>{{ $image }}</h3>
                    <h3>{{ $deskripsi }}</h3>
                    <h3>{{ $quantity }}</h3>
                    <h3>{{ $price }}</h3>
                </div>
            </div> --}}
        </div>
    </div>
</div>
