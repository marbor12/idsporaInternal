<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\TasksController;
use App\Http\Controllers\Api\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index']);
    Route::post('/', [EventController::class, 'store']);
    Route::get('{id}', [EventController::class, 'show']);
    Route::put('{id}', [EventController::class, 'update']);
    Route::delete('{id}', [EventController::class, 'destroy']);
});

Route::prefix('tasks')->group(function () {
    Route::get('/', [TasksController::class, 'index']);
    Route::post('/', [TasksController::class, 'store']);
    Route::get('{id}', [TasksController::class, 'show']);
    Route::put('{id}', [TasksController::class, 'update']);
    Route::delete('{id}', [TasksController::class, 'destroy']);
});


Route::apiResource('users', UserController::class);