<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

// Arahkan halaman utama ke method index di MovieController
Route::get('/', [MovieController::class, 'index'])->name('movies.index');

// Buat rute untuk halaman detail film menggunakan slug
Route::get('/movies/{movie:slug}', [MovieController::class, 'show'])->name('movies.show');
