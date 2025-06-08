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

// Tasks - hanya COO yang boleh create/edit/delete
Route::resource('tasks', TasksController::class)->only(['index', 'show']);
Route::middleware(['auth', 'role:coo'])->group(function () {
    Route::get('/tasks/create', [TasksController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TasksController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TasksController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TasksController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TasksController::class, 'destroy'])->name('tasks.destroy');
});

// Events - hanya PM yang boleh create/edit/delete
Route::resource('events', EventController::class)->only(['index', 'show']);
Route::middleware(['auth', 'role:pm'])->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
});

// Finance (atur sesuai kebutuhan role, contoh: hanya CFO)
Route::get('/finance', [FinanceController::class, 'index'])->name('finance');
Route::middleware(['auth', 'role:cfo'])->group(function () {
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

// Needs approval (CEO)
Route::middleware(['auth', 'role:ceo'])->group(function () {
    Route::get('needs/approval', [NeedController::class, 'approvalList'])->name('needs.approval');
    Route::post('needs/{id}/approve', [NeedController::class, 'approve'])->name('needs.approve');
    Route::post('needs/{id}/reject', [NeedController::class, 'reject'])->name('needs.reject');
});

Route::post('/tasks/{id}/approve', [TasksController::class, 'approve'])->name('tasks.approve');
Route::post('/tasks/{id}/reject', [TasksController::class, 'reject'])->name('tasks.reject');
