<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-4/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container py-5">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Jumlah Terjual</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-center font-weight-bold ">
                            @foreach ($transaksi as $item)
                            <tr>
                                @if ($loop->first)
                                <td>{{ $item->total }}</td>
                                @endif
                                @if ($loop->last)
                                <td>Eh</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>