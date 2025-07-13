<!DOCTYPE html>
<html>
<head>
    <title>Daftar File</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .file-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .file-item:last-child {
            border-bottom: none;
        }
        .file-name a {
            word-break: break-all; /* Agar nama file panjang tidak merusak layout */
        }
        .file-thumbnail {
            max-width: 50px; /* Ukuran thumbnail */
            max-height: 50px;
            margin-right: 10px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Daftar File</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (empty($files))
            <p>Tidak ada file yang diunggah.</p>
        @else
            <ul class="list-unstyled">
                @foreach ($files as $file)
                    <li class="file-item">
                        <span class="file-name d-flex align-items-center">
                            {{-- Tambahkan logika untuk menampilkan gambar jika file adalah gambar --}}
                            @php
                                $extension = pathinfo(basename($file), PATHINFO_EXTENSION);
                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
                            @endphp

                            @if (in_array(strtolower($extension), $imageExtensions))
                                <img src="{{ Storage::url($file) }}" alt="{{ basename($file) }}" class="file-thumbnail">
                            @endif

                            <a href="{{ Storage::url($file) }}" target="_blank">{{ basename($file) }}</a>
                            <a href="{{ route('files.download', ['filename' => basename($file)]) }}" class="btn btn-sm btn-info ml-2">Unduh</a>
                        </span>
                        <form action="{{ route('files.delete', ['filename' => basename($file)]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus file ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif

        <div class="mt-4">
            <a href="{{ route('upload.form') }}" class="btn btn-primary">Unggah File Baru</a>
        </div>
    </div>
</body>
</html>