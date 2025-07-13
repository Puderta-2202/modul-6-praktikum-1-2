<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Terbatas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Selamat Datang di Halaman Terbatas!</div>
                    <div class="card-body">
                        <p>Halo, {{ Auth::user()->name }}!</p>
                        <p>Peran Anda: **{{ Auth::user()->role ?? 'Tidak ada peran' }}**</p>
                        <p>Anda bisa melihat halaman ini karena usia Anda adalah {{ Auth::user()->age }} tahun atau lebih.</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
                        <a href="{{ route('logout') }}" class="btn btn-danger mt-3">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>