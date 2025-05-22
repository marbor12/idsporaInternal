<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use App\Models\BudgetDetail;
use App\Models\Request as BudgetRequest;
use App\Models\Payment;
use App\Models\FinancialReport;
use Illuminate\Http\Request;

use App\Http\Resources\BudgetResource;
use App\Http\Resources\RequestResource;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\FinancialReportResource;

class FinanceController extends Controller
{
    // =========================
    // BUDGETS
    // =========================
    public function getBudgets()
    {
        $budgets = Budget::with('details')->get();
        return BudgetResource::collection($budgets);
    }

    public function createBudget(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|integer',
            'status' => 'required|string',
        ]);
        $budget = Budget::create($validated);
        return new BudgetResource($budget);
    }

    public function updateBudget(Request $request, $id)
    {
        $budget = Budget::findOrFail($id);
        $validated = $request->validate([
            'event_id' => 'sometimes|integer',
            'status' => 'sometimes|string',
        ]);
        $budget->update($validated);
        return new BudgetResource($budget);
    }

    public function deleteBudget($id)
    {
        Budget::destroy($id);
        return response()->json(['message' => 'Budget deleted successfully'], 204);
    }

    // =========================
    // REQUESTS
    // =========================
    public function getRequests()
    {
        $requests = BudgetRequest::with('budget')->get();
        return RequestResource::collection($requests);
    }

    public function createRequest(Request $request)
    {
        $validated = $request->validate([
            'budget_id' => 'required|integer',
            'submitted_by' => 'required|integer',
            'status' => 'required|string',
        ]);
        $requestModel = BudgetRequest::create($validated);
        return new RequestResource($requestModel);
    }

    public function updateRequest(Request $request, $id)
    {
        $requestModel = BudgetRequest::findOrFail($id);
        $validated = $request->validate([
            'status' => 'sometimes|string',
        ]);
        $requestModel->update($validated);
        return new RequestResource($requestModel);
    }

    public function deleteRequest($id)
    {
        BudgetRequest::destroy($id);
        return response()->json(['message' => 'Request deleted successfully'], 204);
    }

    // =========================
    // PAYMENTS
    // =========================
    public function getPayments()
    {
        $payments = Payment::with('request')->get();
        return PaymentResource::collection($payments);
    }

    public function createPayment(Request $request)
    {
        $validated = $request->validate([
            'request_id' => 'required|integer',
            'paid_by' => 'required|integer',
            'payment_date' => 'required|date',
        ]);
        $payment = Payment::create($validated);
        return new PaymentResource($payment);
    }

    public function updatePayment(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $validated = $request->validate([
            'payment_date' => 'sometimes|date',
        ]);
        $payment->update($validated);
        return new PaymentResource($payment);
    }

    public function deletePayment($id)
    {
        Payment::destroy($id);
        return response()->json(['message' => 'Payment deleted successfully'], 204);
    }

    // =========================
    // FINANCIAL REPORTS
    // =========================
    public function getFinancialReports()
    {
        $reports = FinancialReport::all();
        return FinancialReportResource::collection($reports);
    }

    public function createFinancialReport(Request $request)
    {
        $validated = $request->validate([
            'created_by' => 'required|integer',
            'month' => 'required|integer',
            'year' => 'required|integer',
            'status' => 'required|string',
            'amount' => 'required|numeric',
        ]);
        $report = FinancialReport::create($validated);
        return new FinancialReportResource($report);
    }

    public function updateFinancialReport(Request $request, $id)
    {
        $report = FinancialReport::findOrFail($id);
        $validated = $request->validate([
            'status' => 'sometimes|string',
            'amount' => 'sometimes|numeric',
        ]);
        $report->update($validated);
        return new FinancialReportResource($report);
    }

    public function deleteFinancialReport($id)
    {
        FinancialReport::destroy($id);
        return response()->json(['message' => 'Financial report deleted successfully'], 204);
    }
}