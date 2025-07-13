<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Route Praktikum 1
|--------------------------------------------------------------------------
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route-route autentikasi yang secara otomatis ditambahkan oleh `Auth::routes();`
// atau secara eksplisit seperti contoh di modul:
// Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
// Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

// Route::get('/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
// Route::get('/password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

// // Ini adalah route untuk halaman home/dashboard yang biasanya dibuat oleh `php artisan make:auth`
// // atau saat menjalankan `Auth::routes();`
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); -->

/*
|--------------------------------------------------------------------------
| Route Praktikum 2
|--------------------------------------------------------------------------
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// // Route untuk menampilkan form login
// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

// // Route untuk memproses login
// Route::post('/login', [AuthController::class, 'cekLogin'])->name('cek-login');

// // Grup route yang memerlukan autentikasi (middleware 'auth')
// Route::middleware('auth')->group(function () {
//     // Route untuk halaman dashboard
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');

//     // Route untuk logout
//     Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// });

/*
|--------------------------------------------------------------------------
| Route Modul 7
|--------------------------------------------------------------------------
*/

// Route default (opsional, bisa Anda pertahankan atau sesuaikan)
Route::get('/', function () {
    return view('welcome');
});

// Route untuk menampilkan form login (dari Praktikum 2)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Route untuk memproses login (dari Praktikum 2)
Route::post('/login', [AuthController::class, 'cekLogin'])->name('cek-login');

// Grup route yang memerlukan autentikasi (middleware 'auth')
Route::middleware('auth')->group(function () {
    // Route untuk halaman dashboard (dari Praktikum 2)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route untuk logout (dari Praktikum 2)
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route yang dilindungi oleh middleware CheckAge (Tugas Modul 7)
    Route::get('/akses-terbatas', function () {
        return view('restricted_page');
    })->middleware('age.check')->name('restricted.page');
});
