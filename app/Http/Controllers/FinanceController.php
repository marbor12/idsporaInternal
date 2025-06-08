<?php

namespace App\Http\Controllers;

use App\Models\FinancialReport;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller; 


class FinanceController extends Controller
{
    public function index()
    {
        $transactions = FinancialReport::all();

        $totalRevenue = $transactions->where('category', 'revenue')->sum('amount');
        $totalExpenses = $transactions->where('category', 'expenses')->sum('amount');
        $netBalance = $totalRevenue - $totalExpenses;

        // Data untuk grafik, dsb, bisa diolah dari $transactions

        return view('finance.read', [
            'transactions' => $transactions,
            'totalRevenue' => $totalRevenue,
            'totalExpenses' => $totalExpenses,
            'netBalance' => $netBalance,
        ]);
    }

    public function create()
    {
        return view('finance.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'descriptions' => 'required|string',
            'amount' => 'required|numeric',
            'category' => 'required|string',
            'subcategory' => 'required|string',
            'status' => 'required|string',
            'date' => 'required|date',
        ]);
        FinancialReport::create($validated);
        return redirect()->route('finance.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $transaction = FinancialReport::findOrFail($id);
        return view('finance.edit', compact('transaction'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'descriptions' => 'required|string',
            'amount' => 'required|numeric',
            'category' => 'required|string',
            'subcategory' => 'required|string',
            'status' => 'required|string',
            'date' => 'required|date',
        ]);
        $transaction = FinancialReport::findOrFail($id);
        $transaction->update($validated);
        return redirect()->route('finance.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaction = FinancialReport::findOrFail($id);
        $transaction->delete();
        return redirect()->route('finance.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}