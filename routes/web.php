<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanceController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
//Route untuk tasks
Route::resource('tasks', TasksController::class);
Route::get('/tasks', [TasksController::class, 'index'])->name('tasks');
Route::get('/tasks/create', [TasksController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TasksController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{id}/edit', [TasksController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{id}', [TasksController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{id}', [TasksController::class, 'destroy'])->name('tasks.destroy');



// Route::get('/events', function () {
//     return view('events/read');
// })->name('events');

// Route::resource('events', EventController::class);

// Route::get('/events', [EventController::class, 'index'])->name('events');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//Route untuk events
Route::resource('events', EventController::class);
Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');



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


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');







Route::get('/CFO/Dashboard', function () {
    return view('CFO.Dashboard');
})->name('CFO.dashboard');

Route::get('/CFO/budgetReview', function () {
    return view('CFO.BudgetReview');
})->name('CFO.budgetReview');