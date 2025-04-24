<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/tasks', function () {
    return view('tasks/read');
})->name('tasks');

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



Route::get('/finance', function () {
    return view('finance/read');
})->name('finance');

Route::get('/laporan', function () {
    return view('laporan/read');
})->name('laporan');