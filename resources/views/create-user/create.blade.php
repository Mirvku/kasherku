@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('insert-user') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="menuName" class="form-label">Nama User</label>
                        <input name="name" type="text" class="form-control">
                        @error('name')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="menuName" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control">
                        @error('email')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="menuName" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control">
                        @error('password')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="menuName" class="form-label">Password Confirmation</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
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
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
