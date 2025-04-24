@extends('app')

@section('content')
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        @include('sidebar')

        <!-- Main Content -->
        <div class="flex-1 overflow-auto p-4">
            <div>
                <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white border rounded p-4">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 rounded bg-blue-100 flex items-center justify-center text-blue-600 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="3" rx="2" />
                                    <path d="m9 13 2 2 4-4" />
                                </svg>
                            </div>
                            <h3 class="font-medium">Projects</h3>
                        </div>
                        <p class="text-2xl font-bold">12</p>
                    </div>

                    <div class="bg-white border rounded p-4">
                        <div class="flex items-center mb-2">
                            <div
                                class="w-8 h-8 rounded bg-purple-100 flex items-center justify-center text-purple-600 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg>
                            </div>
                            <h3 class="font-medium">Time Tracked</h3>
                        </div>
                        <p class="text-2xl font-bold">20h 30m</p>
                    </div>

                    <div class="bg-white border rounded p-4">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 rounded bg-green-100 flex items-center justify-center text-green-600 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                </svg>
                            </div>
                            <h3 class="font-medium">Revenue</h3>
                        </div>
                        <p class="text-2xl font-bold">$2,190</p>
                    </div>

                    <div class="bg-white border rounded p-4">
                        <div class="flex items-center mb-2">
                            <div
                                class="w-8 h-8 rounded bg-yellow-100 flex items-center justify-center text-yellow-600 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg>
                            </div>
                            <h3 class="font-medium">Team Members</h3>
                        </div>
                        <p class="text-2xl font-bold">21</p>
                    </div>
                </div>

                <!-- Tasks Section -->
                <div class="bg-white border rounded p-4 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-bold">Recent Tasks</h2>
                    </div>

                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2">Task</th>
                                <th class="text-left py-2">Status</th>
                                <th class="text-left py-2">Due Date</th>
                                <th class="text-left py-2">PIC</th>
                                <th class="text-left py-2">Add</th>
                                <th class="text-left py-2">Evidence</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="py-2">Create homepage design</td>
                                <td class="py-2"><span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs">In
                                        Progress</span></td>
                                <td class="py-2">Aug 15, 2024</td>
                                <td class="py-2">Agvin</td>
                                <td class="py-2"><a href="#" class="text-blue-500 text-sm">Add</a></td>
                                <td class="py-2">
                                    @if (false) 
                                        <a href="#" class="text-blue-500 text-sm">Lihat</a>
                                    @else
                                        <span class="text-gray-500 text-sm">Belum tersedia</span>
                                    @endif
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2">Database setup</td>
                                <td class="py-2"><span
                                        class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">Completed</span></td>
                                <td class="py-2">Aug 10, 2024</td>
                                <td class="py-2">-</td>
                                <td class="py-2"><a href="#" class="text-blue-500 text-sm">Add</a></td>
                                <td class="py-2">
                                    @if (true)
                                        <a href="#" class="text-blue-500 text-sm">Lihat</a>
                                    @else
                                        <span class="text-gray-500 text-sm">Belum tersedia</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2">User authentication</td>
                                <td class="py-2"><span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">To
                                        Do</span></td>
                                <td class="py-2">Aug 20, 2024</td>
                                <td class="py-2">-</td>
                                <td class="py-2"><a href="#" class="text-blue-500 text-sm">Add</a></td>
                                <td class="py-2">
                                    @if (false)
                                        <a href="#" class="text-blue-500 text-sm">Lihat</a>
                                    @else
                                        <span class="text-gray-500 text-sm">Belum tersedia</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="flex justify-end mt-4">
                        <a href="{{ route('tasks') }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">View All</a>
                    </div>
                </div>


                <!-- Events Section -->
                <div class="bg-white border rounded p-4">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-bold">Upcoming Events</h2>
                    </div>

                    <ul class="space-y-3">
                        <li class="border-b pb-2">
                            <div class="font-medium">Team Meeting</div>
                            <div class="text-sm text-gray-500">August 12, 2024 - 10:00 AM</div>
                        </li>
                        <li class="border-b pb-2">
                            <div class="font-medium">Project Deadline</div>
                            <div class="text-sm text-gray-500">August 15, 2024</div>
                        </li>
                        <li>
                            <div class="font-medium">Client Presentation</div>
                            <div class="text-sm text-gray-500">August 18, 2024 - 2:00 PM</div>
                        </li>
                    </ul>
                    <a href="{{ route('events') }}" class="text-blue-500">View All</a>
                </div>
            </div>
        </div>
    </div>
@endsection