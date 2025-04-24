<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'date' => '02-02-2025',
        ],
        [
            'id' => 2,
            'descriptions' => 'Fee event kuliah umum',
            'amount' => '2000000',
            'category' => 'revenue',
            'subcategory' => 'event',
            'status' => 'completed',
            'date' => '02-04-2025',
        ],
    ];

    public function index()
    {
        // Jika session kosong, set session dengan data default
        if (!session()->has('transactions')) {
            session(['transactions' => $this->data]);
        }

        // Ambil transaksi dari session
        $transactions = session('transactions');

        // Hitung total revenue
        $totalRevenue = array_reduce($transactions, function ($carry, $item) {
            return $carry + ($item['category'] === 'revenue' ? (int) $item['amount'] : 0);
        }, 0);

        $totalExpenses = array_reduce($transactions, function ($carry, $item) {
            return $carry + ($item['category'] === 'expenses' ? (int) $item['amount'] : 0);
        }, 0);

        $netBalance = $totalRevenue - $totalExpenses;
        // Data untuk grafik ringkasan keuangan (bar chart)
        $monthlyData = [
            ['month' => 'Jan', 'revenue' => 0, 'expenses' => 0],
            ['month' => 'Feb', 'revenue' => 0, 'expenses' => 500000], // Biaya Wifi pada Feb
            ['month' => 'Mar', 'revenue' => 0, 'expenses' => 0],
            ['month' => 'Apr', 'revenue' => 2000000, 'expenses' => 0], // Fee event pada Apr
            ['month' => 'Mei', 'revenue' => 0, 'expenses' => 0],
            ['month' => 'Jun', 'revenue' => 0, 'expenses' => 0],
        ];

        // Data untuk grafik komposisi expenses (pie chart)
        $expenseData = [];
        $expensesByCategory = [];
        
        foreach ($transactions as $transaction) {
            if ($transaction['category'] === 'expenses') {
                $subkategori = $transaction['subcategory'];
                if (!isset($expensesByCategory[$subkategori])) {
                    $expensesByCategory[$subkategori] = 0;
                }
                $expensesByCategory[$subkategori] += (int) $transaction['amount'];
            }
        }
        
        foreach ($expensesByCategory as $kategori => $nilai) {
            $expenseData[] = [
                'kategori' => $kategori,
                'nilai' => $nilai
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
        // Menambahkan data baru ke properti objek
        $new = [
            'id'   => end($this->data)['id'] + 1,
            'descriptions' => $request->descriptions,
            'amount'       => $request->amount,
            'category'     => $request->category,
            'subcategory'  => $request->subcategory,
            'status'       => $request->status,
            'date'         => $request->date,
        ];
        // Pastikan data transaksi dalam session adalah array
        $transactions = session('transactions', $this->data);

        // Tambahkan transaksi baru
        $transactions[] = $new;

        // Simpan kembali ke session
        session(['transactions' => $transactions]);
        return redirect()->route('finance');
    }
    // Menampilkan form edit transaksi
    public function edit($id)
    {
        // Ambil transaksi berdasarkan ID
        $transactions = session('transactions', []);
        $transaction = null;

        foreach ($transactions as $t) {
            if ($t['id'] == $id) {
                $transaction = $t;
                break;
            }
        }

        return view('finance.edit', compact('transaction'));
    }

    // Update transaksi
    public function update(Request $request, $id)
    {
        $transactions = session('transactions', []);

        foreach ($transactions as &$transaction) {
            if ($transaction['id'] == $id) {
                $transaction['date'] = $request->date;
                $transaction['descriptions'] = $request->descriptions;
                $transaction['category'] = $request->category;
                $transaction['amount'] = $request->amount;
                break;
            }
        }

        session(['transactions' => $transactions]);

        return redirect()->route('finance');
    }

    public function destroy($id)
    {
        // Ambil data transaksi dari session
        $transactions = session()->get('transactions', []);

        // Cari index transaksi berdasarkan ID
        $index = null;
        foreach ($transactions as $key => $transaction) {
            if ($transaction['id'] == $id) {
                $index = $key;
                break;
            }
        }

        // Jika ditemukan, hapus transaksi dari array
        if ($index !== null) {
            unset($transactions[$index]);

            // Re-index array
            $transactions = array_values($transactions);

            // Simpan kembali ke session
            session()->put('transactions', $transactions);

            // Redirect ke halaman daftar transaksi setelah penghapusan
            return redirect()->route('finance')->with('success', 'Transaksi berhasil dihapus.');
        }

        // Jika tidak ditemukan, redirect dengan pesan error
        return redirect()->route('finance')->with('error', 'Transaksi tidak ditemukan.');
    }
}
