<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use App\Models\BudgetDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FinanceController extends Controller
{
    // GET /api/finance/budgets
    public function index()
    {
        $budgets = Budget::with('details')->latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $budgets
        ]);
    }

    // GET /api/finance/budgets/{id}
    public function show($id)
    {
        $budget = Budget::with('details')->find($id);

        if (!$budget) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Budget not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $budget
        ]);
    }

    // POST /api/finance/budgets
    public function store(Request $request)
    {
        // Cek role user (misal field 'role' di tabel users)
        if ($request->user()->role !== 'CFO') {
            return response()->json([
                'status' => 'fail',
                'message' => 'Unauthorized. Only CFO can create budgets.'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'event_id'   => 'required|exists:events,id',
            'details'    => 'required|array|min:1',
            'details.*.description' => 'required|string',
            'details.*.amount'      => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'errors' => $validator->errors()
            ], 422);
        }

        $budget = Budget::create([
            'event_id' => $request->event_id
        ]);

        foreach ($request->details as $detail) {
            BudgetDetail::create([
                'budget_id'   => $budget->id,
                'description' => $detail['description'],
                'amount'      => $detail['amount']
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Budget created successfully!',
            'data' => $budget->load('details')
        ], 201);
    }

    // PUT /api/finance/budget/{id}
    public function update(Request $request, $id)
    {
        if ($request->user()->role !== 'CFO') {
            return response()->json([
                'status' => 'fail',
                'message' => 'Unauthorized. Only CFO can create budgets.'
            ], 403);
        }

        $budget = Budget::find($id);

        if (!$budget) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Budget not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'event_id' => 'sometimes|exists:events,id',
            'details' => 'sometimes|array|min:1',
            'details.*.description' => 'required_with:details|string',
            'details.*.amount'      => 'required_with:details|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'errors' => $validator->errors()
            ], 422);
        }

        // Update event_id jika ada
        if ($request->has('event_id')) {
            $budget->event_id = $request->event_id;
            $budget->save();
        }

        // Update details jika dikirim
        if ($request->has('details')) {
            // Hapus dulu detail lama (opsional: bisa juga update saja, sesuai kebutuhan)
            $budget->details()->delete();

            foreach ($request->details as $detail) {
                BudgetDetail::create([
                    'budget_id'   => $budget->id,
                    'description' => $detail['description'],
                    'amount'      => $detail['amount']
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Budget updated successfully!',
            'data' => $budget->load('details')
        ]);
    }

    // DELETE /api/finance/budgets/{id}
    public function destroy(Request $request, $id)
    {
        // Cek apakah user memiliki role CFO
        if ($request->user()->role !== 'CFO') {
            return response()->json([
                'status' => 'fail',
                'message' => 'Unauthorized. Only CFO can delete budgets.'
            ], 403);
        }

        $budget = Budget::find($id);

        if (!$budget) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Budget not found'
            ], 404);
        }

        // Hapus detail dan budget
        $budget->details()->delete();
        $budget->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Budget deleted successfully'
        ]);
    }
}
