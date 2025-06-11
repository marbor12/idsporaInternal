<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use App\Models\BudgetDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FinanceController extends Controller
{
    public function getBudgets()
    {
        $budgets = Budget::with('details')->latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $budgets
        ]);
    }

    public function storeBudget(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_id'   => 'required|exists:events,id',
            'details'    => 'required|array',
            'details.*.description' => 'required|string',
            'details.*.amount'      => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create budget
        $budget = Budget::create([
            'event_id' => $request->event_id
        ]);

        // Save budget details
        foreach ($request->details as $detail) {
            BudgetDetail::create([
                'budget_id'  => $budget->id,
                'description' => $detail['description'],
                'amount'     => $detail['amount']
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Budget created successfully!',
            'data' => $budget->load('details')
        ]);
    }
}