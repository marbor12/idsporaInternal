@extends('app')

@section('content')
<div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    @include('sidebar')

    <!-- Main Content -->
    <div class="flex-1 overflow-auto p-4">
        <div>
            <h1 class="text-2xl font-bold mb-4">Finance</h1>
            
            <!-- Simple Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white border rounded p-4">
                    <h3 class="font-medium mb-1">Total Revenue</h3>
                    <p class="text-2xl font-bold">$24,500</p>
                </div>
                <div class="bg-white border rounded p-4">
                    <h3 class="font-medium mb-1">Expenses</h3>
                    <p class="text-2xl font-bold">$12,300</p>
                </div>
                <div class="bg-white border rounded p-4">
                    <h3 class="font-medium mb-1">Net Profit</h3>
                    <p class="text-2xl font-bold">$12,200</p>
                </div>
            </div>
            
            <!-- Recent Transactions -->
            <div class="bg-white border rounded p-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-medium">Recent Transactions</h2>
                    <button class="px-3 py-1 bg-blue-500 text-white rounded">Add Transaction</button>
                </div>
                
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">Description</th>
                            <th class="text-left py-2">Date</th>
                            <th class="text-left py-2">Amount</th>
                            <th class="text-left py-2">Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-2">Client Payment - ABC Corp</td>
                            <td class="py-2">Aug 05, 2024</td>
                            <td class="py-2 text-green-600">+$8,500</td>
                            <td class="py-2"><span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">Income</span></td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2">Office Rent</td>
                            <td class="py-2">Aug 03, 2024</td>
                            <td class="py-2 text-red-600">-$2,000</td>
                            <td class="py-2"><span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs">Expense</span></td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2">Software Licenses</td>
                            <td class="py-2">Aug 01, 2024</td>
                            <td class="py-2 text-red-600">-$1,200</td>
                            <td class="py-2"><span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs">Expense</span></td>
                        </tr>
                        <tr>
                            <td class="py-2">Client Payment - XYZ Inc</td>
                            <td class="py-2">Jul 28, 2024</td>
                            <td class="py-2 text-green-600">+$6,300</td>
                            <td class="py-2"><span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">Income</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
