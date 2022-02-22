@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ url('/dashboard/create-user/update/' . $user->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="menuName" class="form-label">Nama User</label>
                        <input name="name" value="{{ $user->name }}" type="text" class="form-control">
                        @error('name')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="menuName" class="form-label">Email</label>
                        <input name="email" value="{{ $user->email }}" type="email" class="form-control">
                        @error('email')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="menuName" class="form-label">Role</label>
                        <select name="role" required class="form-control">
                            <option value="administrator">Administrator</option>
                            <option value="kasir">Kasir</option>
                            <option value="waiter">Waiter</option>
                            <option value="owner">Owner</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </form>
            </div>
        </div>
    </div>
@endsection
