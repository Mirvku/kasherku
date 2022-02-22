@extends('layouts.admin')

@section('title', 'Edit Menu')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ url('/dashboard/menu/update/' . $menu->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="menuName" class="form-label">Nama Menu</label>
                        <input name="name" value="{{ $menu->name }}" type="text" class="form-control">
                        @error('name')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="menuImage" class="form-label">Foto Menu</label>
                        <div class="input-group mb-3">
                            <input name="image" type="file" class="form-control-file" id="inputGroupFile02">
                        </div>
                        @error('image')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label">Jumlah</label>
                        <input name="quantity" value="{{ $menu->quantity }}" type=" number" class="form-control">
                        @error('quantity')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label">Harga</label>
                        <input name="price" value="{{ $menu->price }}" type="text" class="form-control">
                        @error('price')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </form>
            </div>
        </div>
    </div>
@endsection
