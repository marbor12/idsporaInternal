<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\TasksController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FinanceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth/login', [LoginController::class, '__invoke']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tasks', TasksController::class);
});

Route::apiResource('events', EventController::class)->middleware('auth:sanctum');
// Route::apiResource('finance', FinanceController::class)->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function() {
    Route::prefix('finance')->group(function () {
        Route::get('/budgets', [FinanceController::class, 'index']);
        Route::post('/budgets', [FinanceController::class, 'store']);
        Route::put('/budgets/{id}', [FinanceController::class, 'update']);
        Route::get('/budgets/{id}', [FinanceController::class, 'show']);
        Route::delete('/budgets/{id}', [FinanceController::class, 'destroy']);
    });
    Route::post('/logout', [LoginController::class, 'logout']);
});
// Route::prefix('events')->group(function () {
//     Route::get('/', [EventController::class, 'index']);
//     Route::post('/', [EventController::class, 'store']);
//     Route::get('{id}', [EventController::class, 'show']);
//     Route::put('{id}', [EventController::class, 'update']);
//     Route::delete('{id}', [EventController::class, 'destroy']);
// });

// Route::prefix('tasks')->group(function () {
//     Route::get('/', [TasksController::class, 'index']);
//     Route::post('/', [TasksController::class, 'store']);
//     Route::get('{id}', [TasksController::class, 'show']);
//     Route::put('{id}', [TasksController::class, 'update']);
//     Route::delete('{id}', [TasksController::class, 'destroy']);
// });

// Route::prefix('users')->group(function () {
//     Route::get('/', [UserController::class, 'index']);
//     Route::post('/', [UserController::class, 'store']);
//     Route::get('{id}', [UserController::class, 'show']);
//     Route::put('{id}', [UserController::class, 'update']);
//     Route::delete('{id}', [UserController::class, 'destroy']);
// });


// Route::apiResource('users', UserController::class);

// Route::prefix('finance')->group(function () {
//     Route::get('/budgets', [FinanceController::class, 'getBudgets']);
//     Route::post('/budgets', [FinanceController::class, 'storeBudget']);
// });