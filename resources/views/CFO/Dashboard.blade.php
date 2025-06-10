@extends('app')
@section('content')
<div class="flex h-screen bg-gray-50">
    @include('CFO.sidebar')
    <div class="w-full m-4">
        <!-- Header -->
        <header class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 pb-3 mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900">CFO Dashboard</h1>
            </div>
        </header>

        <!-- Stats Cards -->
        <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-6">
            <!-- Current Balance -->
            <div class="bg-white border border-gray-100 rounded-lg p-5 shadow-sm">
                <div class="flex justify-between items-center mb-2">
                    <p class="text-gray-600 text-sm font-medium">Current Balance</p>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-blue-600">
                        <path d="M12 7.5a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
                        <path fill-rule="evenodd" d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 14.625v-9.75ZM8.25 9.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM18.75 9a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V9.75a.75.75 0 0 0-.75-.75h-.008ZM4.5 9.75A.75.75 0 0 1 5.25 9h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H5.25a.75.75 0 0 1-.75-.75V9.75Z" clip-rule="evenodd" />
                        <path d="M2.25 18a.75.75 0 0 0 0 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 0 0-.75-.75H2.25Z" />
                    </svg>

                </div>
                <p class="text-2xl font-extrabold text-gray-900">$1,250,000</p>
            </div>

            <!-- Pending Approvals -->
            <div class="bg-white border border-gray-100 rounded-lg p-5 shadow-sm">
                <div class="flex justify-between items-center mb-2">
                    <p class="text-gray-600 text-sm font-medium">Pending Approvals</p>
                    <svg
                        class="w-4 h-4 text-orange-600"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-2xl font-extrabold text-gray-900">8</p>
            </div>

            <!-- Active Events -->
            <div class="bg-white border border-gray-100 rounded-lg p-5 shadow-sm">
                <div class="flex justify-between items-center mb-2">
                    <p class="text-gray-600 text-sm font-medium">Active Events</p>
                    <svg
                        class="w-4 h-4 text-purple-600"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M9 20H4v-2a3 3 0 015.356-1.857M15 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <p class="text-2xl font-extrabold text-gray-900">24</p>
            </div>
        </section>

        <!-- Cash Flow Summary -->
        <section class="bg-white border border-gray-100 rounded-lg p-5 shadow-sm mb-6">
            <h2 class="text-lg font-extrabold text-gray-900 flex justify-center mb-1 ">
                <i class="fas fa-credit-card mr-2"></i> Cash Flow Summary
            </h2>
            <p class="text-gray-500 text-xs mb-4 text-center">Current month financial overview</p>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-center justify-center">
                <div>
                    <p class="text-gray-900 text-sm mb-1">Total Income</p>
                    <p class="text-green-600 font-extrabold text-lg">$850,000</p>
                </div>
                <div>
                    <p class="text-gray-900 text-sm mb-1">Total Expenses</p>
                    <p class="text-red-600 font-extrabold text-lg">$675,000</p>
                </div>
                <div>
                    <p class="text-gray-900 text-sm mb-1">Net Cash Flow</p>
                    <p class="text-green-600 font-extrabold text-lg">$175,000</p>
                </div>
            </div>
        </section>

        <!-- Recent Sections -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white border border-gray-100 rounded-lg p-5 shadow-sm">
                <h3 class="text-lg font-extrabold text-gray-900 flex items-center mb-1">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6 mr-2 text-yellow-500">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v3m0 3h.01M12 4.5c4.14 0 7.5 3.36 7.5 7.5S16.14 19.5 12 19.5 4.5 16.14 4.5 12 7.86 4.5 12 4.5z" />
                    </svg>Recent Budget Requests
                </h3>
                <p class="text-gray-500 text-sm mb-4">Budget requests requiring your attention</p>
                <div class="pb-1">
                    <div class="flex justify-between items-start mb-3 border border-gray-300 rounded-md p-4">
                        <div class="flex-1">
                            <h3 class="text-sm font-semibold text-gray-900">Tech Conference 2024</h3>
                            <div class="text-gray-600">
                                <span class="font-small">$150,000</span> • <span class="text-sm text-gray-400">2024-01-15</span>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800 border border-orange-200">
                            pending
                        </span>
                    </div>
                </div>
                <div class="pb-1">
                    <div class="flex justify-between items-start mb-3 border border-gray-300 rounded-md p-4">
                        <div class="flex-1">
                            <h3 class="text-sm font-semibold text-gray-900">Tech Conference 2024</h3>
                            <div class="text-gray-600">
                                <span class="font-small">$150,000</span> • <span class="text-sm text-gray-400">2024-01-15</span>
                            </div>

                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                            accepted
                        </span>
                    </div>
                </div>
                <a href="#"
                    class="w-full border border-gray-300 text-gray-700 bg-white hover:bg-gray-100 rounded px-4 py-2 text-center block transition-colors duration-200">
                    View All Requests
                </a>

            </div>
            <div class="bg-white border border-gray-100 rounded-lg p-5 shadow-sm">
                <h3 class="text-lg font-extrabold text-gray-900 flex items-center mb-1">
                    <i class="fas fa-dollar-sign mr-2"></i> Recent Transactions
                </h3>
                <p class="text-gray-500 text-sm mb-4">Latest financial activities</p>
                <div class="pb-1">
                    <div class="flex justify-between items-start mb-3 border border-gray-300 rounded-md p-4">
                        <div class="flex-1">
                            <h3 class="text-md font-semibold text-gray-900 ">Fee Speaker for Tech Conference 2024</h3>
                            <div class="text-gray-600 mb-1">
                                <span class="font-medium text-sm">Venue</span> • <span class="text-sm">2024-01-15</spanc>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white text-black border border-black">
                                Event
                            </span>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                            accepted
                        </span>
                    </div>
                </div>
                <a href="#"
                    class="w-full border border-gray-300 text-gray-700 bg-white hover:bg-gray-100 rounded px-4 py-2 text-center block transition-colors duration-200">
                    View All Transactions
                </a>
            </div>
        </section>
    </div>
</div>
@endsection