<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pastikan ini diimpor

class FileUploadController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }

    public function storeFile(Request $request)
    {
        // Validasi Tugas 1: Memastikan hanya file gambar (jpg, jpeg, png) dan ukuran maks 2MB
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Validasi tambahan
        ]);

        $file = $request->file('file');
        // Menyimpan file ke direktori 'public/uploads'
        $path = $file->store('public/uploads'); // Disimpan ke storage/app/public/uploads

        return back()->with('success', 'File berhasil diunggah!')->with('file', $path);
    }

    // Metode untuk menampilkan daftar file (akan ditambahkan di langkah berikutnya)
    public function listFiles()
    {
        $files = Storage::files('public/uploads'); // Mengambil semua file dari public/uploads
        return view('file_list', compact('files'));
    }

    // Metode untuk menghapus file (akan ditambahkan di langkah berikutnya)
    public function deleteFile($filename)
    {
        $filePath = 'public/uploads/' . $filename;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
            return back()->with('success', 'File berhasil dihapus!');
        }
        return back()->with('error', 'File tidak ditemukan atau gagal dihapus.');
    }

    // Metode untuk mengunduh file (tambahan, bukan di modul tapi berguna)
    public function downloadFile($filename)
    {
        $filePath = 'public/uploads/' . $filename;
        if (Storage::exists($filePath)) {
            // Menggunakan basename untuk memastikan nama file yang bersih
            return Storage::download($filePath, basename($filename));
        }
        return back()->with('error', 'File tidak ditemukan.');
    }
}
