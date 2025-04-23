<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

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



Route::get('/events', function () {
    return view('events/read');
})->name('events');

Route::get('/finance', function () {
    return view('finance/read');
})->name('finance');

Route::get('/laporan', function () {
    return view('laporan/read');
})->name('laporan');

Route::get('/laporan', function () {
    return view('laporan');
})->name('laporan');
