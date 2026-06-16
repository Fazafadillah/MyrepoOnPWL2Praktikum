<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/book', [BookController::class, 'index'])->name('book.index');
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
    Route::get('/book/print', [BookController::class, 'print'])->name('book.print');
    Route::get('/book/export', [BookController::class, 'export'])->name('book.export');
    Route::post('/book/store', [BookController::class, 'store'])->name('book.store');
    Route::post('/book/import', [BookController::class, 'import'])->name('book.import');
    Route::get('/book/{id}', [BookController::class, 'edit'])->name('book.edit');
    Route::patch('/book/{id}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('book.destroy');
});


require __DIR__.'/auth.php';
