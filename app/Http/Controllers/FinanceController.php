<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinanceController extends Controller
{
    private $data = [
        [
            'id' => 1,
            'descriptions' => 'Biaya Wifi',
            'amount' => '500000',
            'category' => 'expenses',
            'subcategory' => 'operational',
            'status' => 'pending',
            'date' => '2025-02-02',
        ],
        [
            'id' => 2,
            'descriptions' => 'Fee event kuliah umum',
            'amount' => '2000000',
            'category' => 'revenue',
            'subcategory' => 'event',
            'status' => 'completed',
            'date' => '2025-04-02',
        ],
    ];

    public function index()
    {
        // Jika session kosong, set session dengan data default
        if (!session()->has('transactions')) {
            session(['transactions' => $this->data]);
        }

        // Ambil transaksi dari session
        $transactions = session('transactions', []);

        // Hitung total revenue
        $totalRevenue = array_reduce($transactions, function ($carry, $item) {
            return $carry + ($item['category'] === 'revenue' ? (int) $item['amount'] : 0);
        }, 0);

        // Hitung total expenses
        $totalExpenses = array_reduce($transactions, function ($carry, $item) {
            return $carry + ($item['category'] === 'expenses' ? (int) $item['amount'] : 0);
        }, 0);

        // Hitung net balance
        $netBalance = $totalRevenue - $totalExpenses;

        // Data untuk grafik ringkasan keuangan (bar chart)
        $monthlyData = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // Inisialisasi data bulanan
        foreach ($months as $index => $month) {
            $monthlyData[$index] = [
                'month' => $month,
                'revenue' => 0,
                'expenses' => 0,
            ];
        }

        // Hitung revenue dan expenses per bulan
        foreach ($transactions as $transaction) {
            $monthIndex = (int) \Carbon\Carbon::parse($transaction['date'])->format('m') - 1;
            if ($transaction['category'] === 'revenue') {
                $monthlyData[$monthIndex]['revenue'] += (int) $transaction['amount'];
            } elseif ($transaction['category'] === 'expenses') {
                $monthlyData[$monthIndex]['expenses'] += (int) $transaction['amount'];
            }
        }

        // Data untuk grafik komposisi expenses (pie chart)
        $expenseData = [];
        $expensesByCategory = [];

        foreach ($transactions as $transaction) {
            if ($transaction['category'] === 'expenses') {
                $subcategory = $transaction['subcategory'];
                if (!isset($expensesByCategory[$subcategory])) {
                    $expensesByCategory[$subcategory] = 0;
                }
                $expensesByCategory[$subcategory] += (int) $transaction['amount'];
            }
        }

        foreach ($expensesByCategory as $category => $value) {
            $expenseData[] = [
                'kategori' => $category,
                'nilai' => $value,
            ];
        }

        return view('finance.read', [
            'transaction' => $transactions,
            'totalRevenue' => $totalRevenue,
            'totalExpenses' => $totalExpenses,
            'netBalance' => $netBalance,
            'monthlyData' => $monthlyData,
            'expenseData' => $expenseData,
        ]);
    }

    public function create()
    {
        return view('finance.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        // Ambil transaksi dari session
        $transactions = session('transactions', []);

        // Tentukan ID baru
        $newId = count($transactions) > 0 ? max(array_column($transactions, 'id')) + 1 : 1;

        // Menambahkan data baru
        $new = [
            'id' => $newId,
            'descriptions' => $request->descriptions,
            'amount' => $request->amount,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'status' => $request->status,
            'date' => $request->date,
        ];

        // Tambahkan transaksi baru
        $transactions[] = $new;

        // Simpan kembali ke session
        session(['transactions' => $transactions]);

        return redirect()->route('finance')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Ambil transaksi berdasarkan ID
        $transactions = session('transactions', []);
        $transaction = collect($transactions)->firstWhere('id', $id);

        if (!$transaction) {
            return redirect()->route('finance')->with('error', 'Transaksi tidak ditemukan.');
        }

        return view('finance.edit', compact('transaction'));
    }

    public function update(Request $request, $id)
    {
        $transactions = session('transactions', []);

        foreach ($transactions as &$transaction) {
            if ($transaction['id'] == $id) {
                $transaction['date'] = $request->date;
                $transaction['descriptions'] = $request->descriptions;
                $transaction['category'] = $request->category;
                $transaction['amount'] = $request->amount;
                $transaction['subcategory'] = $request->subcategory;
                $transaction['status'] = $request->status;
                break;
            }
        }

        session(['transactions' => $transactions]);

        return redirect()->route('finance')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Ambil data transaksi dari session
        $transactions = session('transactions', []);

        // Hapus transaksi berdasarkan ID
        $transactions = array_filter($transactions, function ($transaction) use ($id) {
            return $transaction['id'] != $id;
        });

        // Simpan kembali ke session
        session(['transactions' => array_values($transactions)]);

        return redirect()->route('finance')->with('success', 'Transaksi berhasil dihapus.');
    }
}