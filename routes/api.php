<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\TasksController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FinanceController;

// Route login (tidak perlu token)
Route::post('/auth/login', [LoginController::class, '__invoke']);

// Semua route API di-protect oleh sanctum, kecuali login
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [LoginController::class, 'logout']);
    Route::apiResource('tasks', TasksController::class);
    Route::post('tasks/{id}/approve', [TasksController::class, 'approve']);
    Route::post('tasks/{id}/reject', [TasksController::class, 'reject']);

});

