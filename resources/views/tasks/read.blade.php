@extends('app')

@section('content')
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        @include('sidebar')

        <!-- Main Content -->
        <div class="flex-1 overflow-auto p-4">
            <div class="p-6 max-w-6xl mx-auto">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold mb-4">Task Page</h1>
                    <div class="flex items-center gap-3 ml-auto">
                        <button class="bg-orange-400 hover:bg-orange-400 text-white px-4 py-2 rounded-md flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                            New Task
                        </button>
                    </div>
                </div>

                <!-- Task Stats -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <!-- Total Tasks Card -->
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-1">
                                <div class="w-8 h-8 rounded-md bg-purple-50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="18" height="18" x="3" y="3" rx="2" />
                                        <path d="M3 9h18" />
                                        <path d="M9 21V9" />
                                    </svg>
                                </div>
                                <div class="text-m text-gray-500">Total Tasks</div>
                            </div>
                            <div class="text-2xl font-bold text-center">42</div>
                        </div>
                    </div>

                    <!-- Completed Tasks Card -->
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-1">
                                <div class="w-8 h-8 rounded-md bg-green-50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z" />
                                        <path d="m9 12 2 2 4-4" />
                                    </svg>
                                </div>
                                <div class="text-m text-gray-500">Completed Tasks</div>
                            </div>
                            <div class="text-2xl font-bold text-center">18</div>
                        </div>
                    </div>

                    <!-- In Progress Tasks Card -->
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-1">
                                <div class="w-8 h-8 rounded-md bg-blue-50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z" />
                                        <path d="M12 6v6l4 2" />
                                    </svg>
                                </div>
                                <div class="text-m text-gray-500">In Progress</div>
                            </div>
                            <div class="text-2xl font-bold text-center">15</div>
                        </div>
                    </div>

                    <!-- Overdue Tasks Card -->
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-1">
                                <div class="w-8 h-8 rounded-md bg-red-50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 8v4l3 3" />
                                        <circle cx="12" cy="12" r="10" />
                                    </svg>
                                </div>
                                <div class="text-m text-gray-500">Overdue</div>
                            </div>
                            <div class="text-2xl font-bold text-center">9</div>
                        </div>
                    </div>
                </div>

                <!-- Filter & Search -->
                <div class="bg-white border rounded p-4 mb-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div class="relative col-span-2">
                        <img src="https://cdn-icons-png.flaticon.com/512/4347/4347487.png" alt="Search Icon"
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 opacity-50">
                        <input type="text" placeholder="Search task (title/description)"
                            class="pl-10 border rounded px-3 py-2 w-full">
                    </div>

                    <!-- Dropdown: Events -->
                    <div>
                        <select class="w-full border rounded px-3 py-2 padding-0">
                            <option>All Events</option>
                            <option>Webinar AI 2025</option>
                            <option>Pelatihan BUMN</option>
                        </select>
                    </div>

                    <!-- Dropdown: Status -->
                    <div>
                        <select class="w-full border rounded px-3 py-2">
                            <option>All Status</option>
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="done">Done</option>
                        </select>
                    </div>

                    <!-- Dropdown: Assigned To -->
                    <div>
                        <select class="w-full border rounded px-3 py-2">
                            <option>Assigned to (All)</option>
                            <option>Rani</option>
                            <option>Agvin</option>
                        </select>
                    </div>
                </div>

                <!-- Daftar Task -->
                <div class="bg-white border rounded p-4">
                    <table class="w-full text-l">
                        <thead>
                            <tr class="border-b font-semibold text-center">
                                <th class="py-2">Task Tittle</th>
                                <th class="py-2">Related Event</th>
                                <th class="py-2">Assigned to</th>
                                <th class="py-2">Deadline</th>
                                <th class="py-2">Status</th>
                                <th class="py-2">Evidence</th>
                                <th class="py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b text-center">
                                <td class="py-2 text-left">Kirim Sertifikat</td>
                                <td class="py-2">Webinar AI 2025</td>
                                <td class="py-2 text-center">Rani</td>
                                <td class="py-2">22 Apr 2025</td>
                                <td class="py-2 text-center">
                                    <span class="px-2 py-1 rounded text-xs bg-yellow-100 text-yellow-800 text-center">In
                                        Progress</span>
                                </td>
                                <td class="py-2">
                                    @if (false) {{-- Ganti dengan kondisi real evidence --}}
                                        <a href="#" class="text-blue-500 text-sm">See</a>
                                    @else
                                        <span class="text-gray-500 text-sm">Unavailable</span>
                                    @endif
                                </td>
                                <td class="py-2">
                                    <a href="#" class="text-blue-600 hover:underline">Edit</a> /
                                    <a href="#" class="text-red-600 hover:underline">Delete</a>
                                </td>
                            </tr>
                            <tr class="border-b text-center">
                                <td class="py-2 text-left">Cek Vendor Ruang</td>
                                <td class="py-2">Pelatihan BUMN</td>
                                <td class="py-2 text-center">Agvin</td>
                                <td class="py-2">24 Apr 2025</td>
                                <td class="py-2 text-center">
                                    <span class="px-2 py-1 rounded text-xs bg-red-100 text-red-800">Pending</span>
                                </td>
                                <td class="py-2">
                                    @if (false) {{-- Ganti dengan kondisi real evidence --}}
                                        <a href="#" class="text-blue-500 text-sm">Lihat</a>
                                    @else
                                        <span class="text-gray-500 text-sm">Unavailable</span>
                                    @endif
                                </td>
                                <td class="py-2">
                                    <a href="#" class="text-blue-600 hover:underline">Edit</a> /
                                    <a href="#" class="text-red-600 hover:underline">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
@endsection