@extends('layouts.admin')
@section('title', 'Laporan Bulanan')

@section('content')
    <div class="container">
         <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cetak Laporan Bulanan</h1>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="menuName" class="form-label">Tanggal Awal</label>
                    <input type="date" name="tglawal" id="tglawal" class="form-control" required>
                    @error('name')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="menuName" class="form-label">Tanggal Akhir</label>
                    <input  type="date" name="tglakhir" id="tglakhir" class="form-control" required>
                    @error('email')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <a href="" onclick="this.href='/dashboard/laporan-bulanan/'+document.getElementById('tglawal').value +
                '/'+document.getElementById('tglakhir').value" target="_blank" class="btn btn-success px-5">Cetak <i class="fa-solid fa-print fa-sm"></i></a>
                {{-- <button type="submit" class="btn btn-success px-5">Cetak</button> --}}
            </div>
        </div>
    </div>
@endsection