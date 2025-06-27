<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MovieController;
use App\Http\Middleware\RoleAdmin;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'admin']);

