<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\TasksController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FinanceController;

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

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('{id}', [UserController::class, 'show']);
    Route::put('{id}', [UserController::class, 'update']);
    Route::delete('{id}', [UserController::class, 'destroy']);
});


Route::apiResource('users', UserController::class);

// BUDGETS
Route::get('/finance/budgets', [FinanceController::class, 'getBudgets']);
Route::post('/finance/budgets', [FinanceController::class, 'createBudget']);
Route::put('/finance/budgets/{id}', [FinanceController::class, 'updateBudget']);
Route::delete('/finance/budgets/{id}', [FinanceController::class, 'deleteBudget']);

// REQUESTS
Route::get('/finance/requests', [FinanceController::class, 'getRequests']);
Route::post('/finance/requests', [FinanceController::class, 'createRequest']);
Route::put('/finance/requests/{id}', [FinanceController::class, 'updateRequest']);
Route::delete('/finance/requests/{id}', [FinanceController::class, 'deleteRequest']);

// PAYMENTS
Route::get('/finance/payments', [FinanceController::class, 'getPayments']);
Route::post('/finance/payments', [FinanceController::class, 'createPayment']);
Route::put('/finance/payments/{id}', [FinanceController::class, 'updatePayment']);
Route::delete('/finance/payments/{id}', [FinanceController::class, 'deletePayment']);

// FINANCIAL REPORTS
Route::get('/finance/reports', [FinanceController::class, 'getFinancialReports']);
Route::delete('/finance/reports/{id}', [FinanceController::class, 'deleteFinancialReport']);