<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


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
Route::post('/finance/reports', [FinanceController::class, 'createFinancialReport']);
Route::put('/finance/reports/{id}', [FinanceController::class, 'updateFinancialReport']);
Route::delete('/finance/reports/{id}', [FinanceController::class, 'deleteFinancialReport']);
