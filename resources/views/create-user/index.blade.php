@extends('layouts.admin')
@section('title', 'create user')

@section('content')
    <div class="container">
        {{-- Header --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create User</h1>
            @if (Auth::user()->role == 'owner')
                <a href="{{ route('tambah-user') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fa-solid fa-plus fa-sm text-white-50"></i> Tambah User
                </a>
            @endif
        </div>
        <div class="row">
            <div class="card card-body shadow">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Role</th>
                                @if (Auth::user()->role == 'owner')
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($user as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->role }}</td>
                                    @if (Auth::user()->role == 'owner')
                                        <td>
                                            <a href="{{ url('/dashboard/create-user/edit/' . $item->id) }}"
                                                class="btn btn-info">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ url('/dashboard/create-user/hapus/' . $item->id) }}"
                                                method="post" class="d-inline">
                                                @csrf
                                                <button class="btn btn-danger my-2">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- <div class="row ">
            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-responsive table-bordered table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Himawari</td>
                                <td>Owner</td>
                                <td>
                                    <a href="#" class="btn btn-primary my-2">
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
