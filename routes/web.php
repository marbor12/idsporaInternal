<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NeedController;

// Landing
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Tasks (batasi role di controller)
Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TasksController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::post('/tasks/{id}/approve', [TasksController::class, 'approve'])->name('tasks.approve');
    Route::post('/tasks/{id}/reject', [TasksController::class, 'reject'])->name('tasks.reject');
});

// Events (batasi role di controller)
Route::middleware(['auth'])->group(function () {
    Route::resource('events', EventController::class);
    // Needs CRUD
    Route::get('/needs/create/{event_id}', [NeedController::class, 'create'])->name('needs.create');
    Route::post('/needs', [NeedController::class, 'store'])->name('needs.store');
    Route::get('/needs/{need}/edit', [NeedController::class, 'edit'])->name('needs.edit');
    Route::put('/needs/{need}', [NeedController::class, 'update'])->name('needs.update');
    Route::delete('/needs/{need}', [NeedController::class, 'destroy'])->name('needs.destroy');
});

// Finance (batasi role di controller)
Route::middleware(['auth'])->group(function () {
    Route::get('/finance', [FinanceController::class, 'index'])->name('finance');
    Route::get('/finance/create', [FinanceController::class, 'create'])->name('finance.create');
    Route::post('/finance', [FinanceController::class, 'store'])->name('finance.store');
    Route::get('/finance/{id}/edit', [FinanceController::class, 'edit'])->name('finance.edit');
    Route::put('/finance/{id}', [FinanceController::class, 'update'])->name('finance.update');
    Route::delete('/finance/{id}', [FinanceController::class, 'destroy'])->name('finance.destroy');
});

// Laporan
Route::get('/laporan', function () {
    return view('laporan/read');
})->name('laporan');

// Auth
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Needs approval (batasi role di controller)
Route::middleware(['auth'])->group(function () {
    Route::get('needs/approval', [NeedController::class, 'approvalList'])->name('needs.approval');
    Route::post('needs/{id}/approve', [NeedController::class, 'approve'])->name('needs.approve');
    Route::post('needs/{id}/reject', [NeedController::class, 'reject'])->name('needs.reject');
});