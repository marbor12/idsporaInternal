@extends('app')
@section('content')
<div class="flex h-screen bg-gray-50">
    @include('CFO.sidebar')
    <div class="w-full m-4">
        <!-- Header -->
        <header class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 pb-3 ">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900">Budget Review</h1>
            </div>
        </header>

        <div class="max-w-7xl mx-auto px-6 py-6">
            <!-- Tabs -->
            <div class="flex space-x-8 mb-8 border-b border-gray-200">
                <button id="pending-tab" class="flex items-center space-x-2 pb-4 border-b-2 border-black text-black font-medium">
                    <div class="w-5 h-5 bg-black rounded-full flex items-center justify-center">
                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <span>Pending (2)</span>
                </button>
                <button id="reviewed-tab" class="flex items-center space-x-2 pb-4 text-gray-500">
                    <div class="w-5 h-5 bg-gray-300 rounded-full flex items-center justify-center">
                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <span>Reviewed (0)</span>
                </button>
                <button id="approved-tab" class="flex items-center space-x-2 pb-4 text-gray-500">
                    <div class="w-5 h-5 bg-gray-300 rounded-full flex items-center justify-center">
                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <span>Approved Payments (3)</span>
                </button>
            </div>

            <!-- Budget Request Card -->
            <div id="pending" class="bg-white rounded-lg border-l-4 border-orange-400 p-8 mb-6">
                <!-- Header -->
                <div class="flex justify-between items-start mb-6">
                    <div class="flex items-start space-x-4">
                        <div>
                            <div class="flex items-center space-x-3 mb-2">
                                <h2 class="text-2xl font-bold text-gray-900">Music Festival Summer</h2>
                                <span class="bg-gray-800 text-white px-3 py-1 rounded-full text-xs font-medium">
                                    medium priority
                                </span>
                            </div>
                            <div class="flex items-center space-x-4 text-gray-600">
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Sarah Johnson</span>
                                </div>
                                <span>•</span>
                                <span>Entertainment</span>
                                <div class="flex items-center space-x-1 ml-4">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Event: 2024-06-20</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-green-600 mb-1">$500,000</div>
                        <div class="text-gray-500">Submitted: 2024-01-14</div>
                    </div>
                </div>

                <!-- Description -->
                <p class="text-gray-700 mb-8 text-lg">
                    3-day music festival featuring multiple stages, food vendors, and camping facilities for 5000+ attendees.
                </p>

                <!-- Budget Breakdown -->
                <div class="mb-8">
                    <div class="flex items-center space-x-2 mb-6">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900">Budget Breakdown</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Artists:</span>
                                <span class="font-semibold">$200,000</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Equipment:</span>
                                <span class="font-semibold">$60,000</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Venue:</span>
                                <span class="font-semibold">$150,000</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Marketing:</span>
                                <span class="font-semibold">$25,000</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Security:</span>
                                <span class="font-semibold">$50,000</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Miscellaneous:</span>
                                <span class="font-semibold">$15,000</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attachments -->
                <div class="mb-8">
                    <div class="flex items-center space-x-2 mb-4">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900">Attachments</h3>
                    </div>

                    <div class="flex space-x-4">
                        <div class="bg-gray-100 px-4 py-2 rounded-lg text-gray-700 font-medium">
                            artist-contracts.pdf
                        </div>
                        <div class="bg-gray-100 px-4 py-2 rounded-lg text-gray-700 font-medium">
                            security-plan.pdf
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-4">
                    <button class="flex-1 bg-green-600 hover:bg-green-700 text-white py-4 px-6 rounded-lg font-semibold flex items-center justify-center space-x-2 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Approve</span>
                    </button>
                    <button class="flex-1 bg-red-600 hover:bg-red-700 text-white py-4 px-6 rounded-lg font-semibold flex items-center justify-center space-x-2 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Reject</span>
                    </button>
                </div>
            </div>
            <div id="reviewed" class="border-l-4 border-l-red-500 border rounded shadow mb-6">
                <div class="p-4 flex items-start justify-between">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2 font-semibold text-lg">
                            Music Festival Summer
                            <!-- Status badge -->
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Rejected
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-200 text-gray-800">
                                medium priority
                            </span>
                        </div>
                        <div class="flex items-center gap-4 text-sm text-gray-600">
                            <span class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.879 6.196a9 9 0 01-13.758 11.608z" />
                                </svg>
                                Sarah Johnson • Entertainment
                            </span>
                            <span class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 4h10m-5 0v10m-5 0h10" />
                                </svg>
                                Event: 2024-06-20
                            </span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-red-600">$500,000</div>
                        <div class="text-sm text-gray-500">Reviewed on: 2024-01-15</div>
                    </div>
                </div>

                <div class="p-4 space-y-4">
                    <p class="text-gray-700">3-day music festival featuring multiple stages, food vendors, and camping facilities for 5000+ attendees.</p>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium mb-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Budget Breakdown
                        </h4>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 text-sm">
                            <div class="flex justify-between"><span class="text-gray-600">Artists:</span><span class="font-medium">$200,000</span></div>
                            <div class="flex justify-between"><span class="text-gray-600">Venue:</span><span class="font-medium">$150,000</span></div>
                            <div class="flex justify-between"><span class="text-gray-600">Security:</span><span class="font-medium">$50,000</span></div>
                            <div class="flex justify-between"><span class="text-gray-600">Equipment:</span><span class="font-medium">$60,000</span></div>
                            <div class="flex justify-between"><span class="text-gray-600">Marketing:</span><span class="font-medium">$25,000</span></div>
                            <div class="flex justify-between"><span class="text-gray-600">Miscellaneous:</span><span class="font-medium">$15,000</span></div>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-medium mb-2 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20h9m-9 0H3m6-6v6m0-6H9m0-4h6m-3-4h3m-3-4h6" />
                            </svg>
                            Attachments
                        </h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full border text-sm hover:bg-gray-100 cursor-pointer">
                                artist-contracts.pdf
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full border text-sm hover:bg-gray-100 cursor-pointer">
                                security-plan.pdf
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="approved" class="border rounded-lg shadow p-4 space-y-4">
                <!-- Header -->
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold flex items-center gap-2">
                            Tech Conference 2024
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Approved
                            </span>
                        </h3>
                        <p class="text-sm text-gray-500">Event: 2024-03-15 • Approved: 2024-01-16</p>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-green-600">$150,000</div>
                        <div class="text-sm text-gray-500">$30,000 paid • $120,000 remaining</div>
                    </div>
                </div>

                <!-- Budget Breakdown -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="font-medium mb-3">Budget Breakdown & Payment Status</h4>
                    <div class="space-y-3">
                        <!-- Venue -->
                        <div class="flex items-center justify-between border rounded p-3 bg-white">
                            <div>
                                <p class="font-medium">Venue</p>
                                <p class="text-xs text-gray-500">$30,000 paid of $60,000</p>
                            </div>
                            <button class="bg-blue-500 text-white text-xs px-3 py-1 rounded hover:bg-blue-600">Pay</button>
                            <p class="text-xs text-gray-700">$30,000 left</p>
                        </div>
                        <!-- Catering -->
                        <div class="flex items-center justify-between border rounded p-3 bg-white">
                            <div>
                                <p class="font-medium">Catering</p>
                                <p class="text-xs text-gray-500">$0 paid of $35,000</p>
                            </div>
                            <button class="bg-blue-500 text-white text-xs px-3 py-1 rounded hover:bg-blue-600">Pay</button>
                            <p class="text-xs text-gray-700">$35,000 left</p>
                        </div>
                        <!-- Speakers -->
                        <div class="flex items-center justify-between border rounded p-3 bg-white">
                            <div>
                                <p class="font-medium">Speakers</p>
                                <p class="text-xs text-gray-500">$0 paid of $25,000</p>
                            </div>
                            <button class="bg-blue-500 text-white text-xs px-3 py-1 rounded hover:bg-blue-600">Pay</button>
                            <p class="text-xs text-gray-700">$25,000 left</p>
                        </div>
                        <!-- Marketing -->
                        <div class="flex items-center justify-between border rounded p-3 bg-white">
                            <div>
                                <p class="font-medium">Marketing</p>
                                <p class="text-xs text-gray-500">$0 paid of $15,000</p>
                            </div>
                            <button class="bg-blue-500 text-white text-xs px-3 py-1 rounded hover:bg-blue-600">Pay</button>
                            <p class="text-xs text-gray-700">$15,000 left</p>
                        </div>
                        <!-- Equipment -->
                        <div class="flex items-center justify-between border rounded p-3 bg-white">
                            <div>
                                <p class="font-medium">Equipment</p>
                                <p class="text-xs text-gray-500">$0 paid of $10,000</p>
                            </div>
                            <button class="bg-blue-500 text-white text-xs px-3 py-1 rounded hover:bg-blue-600">Pay</button>
                            <p class="text-xs text-gray-700">$10,000 left</p>
                        </div>
                        <!-- Miscellaneous -->
                        <div class="flex items-center justify-between border rounded p-3 bg-white">
                            <div>
                                <p class="font-medium">Miscellaneous</p>
                                <p class="text-xs text-gray-500">$0 paid of $5,000</p>
                            </div>
                            <button class="bg-blue-500 text-white text-xs px-3 py-1 rounded hover:bg-blue-600">Pay</button>
                            <p class="text-xs text-gray-700">$5,000 left</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Payments -->
                <div class="pt-2">
                    <h4 class="font-medium mb-2">Recent Payments</h4>
                    <div class="bg-white border rounded p-3 flex justify-between items-center">
                        <div>
                            <p class="font-medium">Venue</p>
                            <p class="text-xs text-gray-500">Venue deposit payment</p>
                        </div>
                        <div class="text-right">
                            <p class="font-medium">$30,000</p>
                            <p class="text-xs text-gray-500">2024-01-17</p>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<script>
    const tabs = ['pending', 'reviewed', 'approved'];

    tabs.forEach(tab => {
        document.getElementById(`${tab}-tab`).addEventListener('click', () => {
            // Update tab button styles
            tabs.forEach(t => {
                const tabButton = document.getElementById(`${t}-tab`);
                const iconCircle = tabButton.querySelector('div');

                if (t === tab) {
                    // Active
                    tabButton.classList.add('border-b-2', 'border-black', 'text-black', 'font-medium');
                    tabButton.classList.remove('text-gray-500');
                    iconCircle.classList.remove('bg-gray-300');
                    iconCircle.classList.add('bg-black');
                } else {
                    // Inactive
                    tabButton.classList.remove('border-b-2', 'border-black', 'text-black', 'font-medium');
                    tabButton.classList.add('text-gray-500');
                    iconCircle.classList.remove('bg-black');
                    iconCircle.classList.add('bg-gray-300');
                }
            });

            // Show the correct content
            tabs.forEach(t => {
                const content = document.getElementById(t);
                if (t === tab) {
                    content.classList.remove('hidden');
                } else {
                    content.classList.add('hidden');
                }
            });
        });
    });
</script>
@endsection