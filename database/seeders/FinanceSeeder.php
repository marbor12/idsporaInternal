<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Budget;
use App\Models\BudgetDetail;
use App\Models\Request as BudgetRequest;
use App\Models\Payment;
use App\Models\FinancialReport;
use Illuminate\Support\Str;

class FinanceSeeder extends Seeder
{
    public function run(): void
    {
        // Loop beberapa event budget
        for ($i = 1; $i <= 5; $i++) {
            $budget = Budget::create([
                'event_id' => $i,
                'status' => 'approved',
            ]);

            // Buat beberapa detail untuk tiap budget
            for ($j = 1; $j <= 3; $j++) {
                BudgetDetail::create([
                    'budget_id' => $budget->id,
                    'item' => 'Item ' . $j,
                    'amount' => rand(100000, 500000),
                ]);
            }

            // Buat 1 permintaan untuk budget ini
            $request = BudgetRequest::create([
                'budget_id' => $budget->id,
                'submitted_by' => 'user_' . $i,
                'status' => 'pending',
            ]);

            // Buat 1 pembayaran dari request
            Payment::create([
                'request_id' => $request->id,
                'paid_by' => 'finance_user_' . $i,
                'payment_date' => now()->subDays(rand(1, 10)),
            ]);
        }

        // Buat beberapa laporan keuangan
        for ($k = 1; $k <= 3; $k++) {
            FinancialReport::create([
                'created_by' => 'finance_admin',
                'month' => $k,
                'year' => 2025,
                'status' => 'verified',
                'amount' => rand(1000000, 5000000),
            ]);
        }
    }
}