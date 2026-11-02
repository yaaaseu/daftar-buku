<?php

use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/buku');

// 'dashboard' tetap ada karena Breeze mengarahkan ke sini setelah login — kita belokkan ke daftar buku
Route::get('/dashboard', fn () => redirect()->route('buku.index'))
    ->middleware('auth')->name('dashboard');

// Hanya pengguna LOGIN yang boleh tambah / ubah / hapus
Route::middleware('auth')->group(function () {
    Route::get('buku/create', [BukuController::class, 'create'])->name('buku.create');
    Route::post('buku', [BukuController::class, 'store'])->name('buku.store');
    Route::get('buku/{buku}/edit', [BukuController::class, 'edit'])->name('buku.edit');
    Route::put('buku/{buku}', [BukuController::class, 'update'])->name('buku.update');
    Route::delete('buku/{buku}', [BukuController::class, 'destroy'])->name('buku.destroy');
});

// Boleh dilihat SIAPA SAJA
Route::get('buku', [BukuController::class, 'index'])->name('buku.index');
Route::get('buku/{buku}', [BukuController::class, 'show'])->name('buku.show');

require __DIR__.'/auth.php';