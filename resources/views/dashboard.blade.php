@extends('app')
@section('content')
    <div class="flex h-screen bg-gray-50">
        @include('sidebar')

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
                            <h3 class="font-medium">Events</h3>
                        </div>
                        <p class="text-2xl font-bold">{{ $totalEvents ?? 0 }}</p>
                    </div>
                    <div class="bg-white border rounded p-4">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 rounded bg-purple-100 flex items-center justify-center text-purple-600 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg>
                            </div>
                            <h3 class="font-medium">Expenses</h3>
                        </div>
                        <p class="text-2xl font-bold">Rp {{ number_format($totalExpenses ?? 0, 0, ',', '.') }}</p>
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
                        <p class="text-2xl font-bold">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-white border rounded p-4">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 rounded bg-yellow-100 flex items-center justify-center text-yellow-600 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 6v6l4 2" />
                                </svg>
                            </div>
                            <h3 class="font-medium">To-Do</h3>
                        </div>
                        <p class="text-2xl font-bold">{{ $totalTasks ?? 0 }}</p>
                    </div>
                </div>

                                <!-- COO: Tombol Buat Task Baru -->
                <!-- @if(Auth::check() && Auth::user()->role === 'coo')
                    <div class="mb-4">
                        <a href="{{ route('tasks.create') }}"
                           class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-semibold">
                            + Buat Task Baru
                        </a>
                    </div>
                @endif -->
                
                <!-- PM: Tombol Buat Event Baru -->
                @if(Auth::check() && Auth::user()->role === 'pm')
                    <div class="mb-4">
                        <a href="{{ route('events.create') }}"
                           class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 font-semibold">
                            + Buat Event Baru
                        </a>
                    </div>
                @endif

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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentTasks ?? [] as $task)
                                <tr class="border-b">
                                    <td class="py-2">{{ $task->title ?? 'N/A' }}</td>
                                    <td class="py-2">
                                        <span class="px-2 py-1 rounded text-xs 
                                                    @if($task->status === 'completed') bg-green-100 text-green-800 
                                                    @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-800 
                                                    @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $task->status ?? 'Unknown')) }}
                                        </span>
                                    </td>
                                    <td class="py-2">
                                        {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : 'N/A' }}
                                    </td>
                                    <td class="py-2">{{ $task->assigned_to ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-gray-500">No recent tasks found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <a href="{{ route('tasks.index') }}" class="text-blue-500">View All</a>
                </div>

                <!-- Events Section -->
                <div class="bg-white border rounded p-4">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-bold">Upcoming Events</h2>
                    </div>
                    <ul class="space-y-3">
                        @forelse ($upcomingEvents ?? [] as $event)
                            <li class="border-b pb-2">
                                <div class="font-medium">{{ $event->title }}</div>
                                <div class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                                    @if($event->time)
                                        - {{ $event->time }}
                                    @endif
                                </div>
                            </li>
                        @empty
                            <li class="text-gray-500">No upcoming events.</li>
                        @endforelse
                    </ul>
                    <a href="{{ route('events.index') }}" class="text-blue-500">View All</a>
                </div>
            </div>
        </div>
    </div>
@endsection