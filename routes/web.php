<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanceController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/tasks', function () {
    return view('tasks/read');
})->name('tasks');

Route::get('/events', function () {
    return view('events/read');
})->name('events');

Route::get('/finance', [FinanceController::class, 'index'])->name('finance');
Route::get('/finance/create', [FinanceController::class, 'create'])->name('finance.create');
Route::post('/finance', [FinanceController::class, 'store'])->name('finance.store');
// Route untuk halaman edit
Route::get('/finance/{id}/edit', [FinanceController::class, 'edit'])->name('finance.edit');
// Route untuk update transaksi
Route::put('/finance/{id}', [FinanceController::class, 'update'])->name('finance.update');
//delete
Route::delete('/finance/{id}', [FinanceController::class, 'destroy'])->name('finance.destroy');

Route::get('/laporan', function () {
    return view('laporan/read');
})->name('laporan');

Route::get('/laporan', function () {
    return view('laporan');
})->name('laporan');
