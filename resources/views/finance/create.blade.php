@extends('app')

@section('content')
<div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    @include('sidebar')

    <!-- Main Content -->
    <div class="flex-1 overflow-auto p-6">
        <div class=" mx-auto bg-white rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-semibold mb-4">Add Transaction</h2>
            <form class="space-y-6" action="{{ route('finance.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1" >Description</label>
                        <input type="text" placeholder="Deskripsi transaksi" name="descriptions"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Amount (Rp)</label>
                        <input type="number" placeholder="0" name="amount"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
                    </div>
                </div>


                <!-- Kategori & Subkategori -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Category</label>
                        <select name="category" class="w-full border border-gray-300 rounded px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="">Choose Category</option>
                            <option value="revenue">Revenue</option>
                            <option value="expenses">Expenses</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Sub Category</label>
                        <select name="subcategory" class="w-full border border-gray-300 rounded px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="">Choose Sub Category</option>
                            <option value="event">Event</option>
                            <option value="operational">Operational</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>

                <!-- Tanggal & Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Status</label>
                        <select id="subcatSelect" name="status" class="w-full border border-gray-300 rounded px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="">Choose Status</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Date</label>
                        <input type="date" name="date"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end space-x-2">
                    <a href="{{ route("finance") }}">
                        <button type="button"
                            class="px-4 py-2 border border-gray-400 rounded hover:bg-gray-100">
                            Back
                        </button>
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 flex items-center space-x-2">
                        <span>Save</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        @endsection