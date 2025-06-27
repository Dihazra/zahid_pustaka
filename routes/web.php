<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MovieController;
use App\Http\Middleware\RoleAdmin;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PinjamController;

use function Pest\Laravel\get;

Route::get('/admin', function () {
    return view('books.dashboard');
});

Route::get('/', [BookController::class, 'homepage']);

Route::get('/login', [AuthController::class, 'LoginForm'])->name('login');
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/create-book', [BookController::class, 'create']);
    Route::post('/create-book', [BookController::class, 'store']);
    Route::get('/edit-book/{id}', [BookController::class, 'edit']);
    Route::put('/update-book/{id}', [BookController::class, 'update']);
    Route::delete('/delete-book/{id}', [BookController::class, 'destroy']);
});

Route::get('/books', [BookController::class, 'index'])->name('books.index');


Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'admin']);

Route::middleware(['auth'])->group(function () {
    // Route untuk memproses peminjaman buku
    // Menggunakan POST karena ini adalah proses yang mengubah data
    Route::post('/pinjam/{bookId}', [PinjamController::class, 'pinjam'])->name('pinjam.book');

    // Route untuk menampilkan daftar buku yang sedang dipinjam oleh user
    Route::get('/my-loans', [PinjamController::class, 'myLoans'])->name('my.loans');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // Rute untuk menampilkan daftar semua pinjaman (untuk admin)
    Route::get('/admin/pinjaman', [PinjamController::class, 'indexPinjaman'])->name('pinjaman.index');

    // Rute untuk mengkonfirmasi pinjaman
    Route::post('/admin/pinjaman/{id}/konfirmasi', [PinjamController::class, 'konfirmasi'])->name('pinjam.konfirmasi');

    // Rute untuk menolak pinjaman
    Route::post('/admin/pinjaman/{id}/tolak', [PinjamController::class, 'tolak'])->name('pinjam.tolak');
});
