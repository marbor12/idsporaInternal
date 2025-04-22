<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/finance', function () {
    return view('finance/read');
})->name('finance');

Route::get('/laporan', function () {
    return view('laporan/read');
})->name('laporan');

Route::get('/laporan', function () {
    return view('laporan');
})->name('laporan');
