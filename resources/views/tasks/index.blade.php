@extends('app')

@section('content')
    <div class="flex h-screen bg-gray-50">
        @include('sidebar')

        <div class="flex-1 overflow-auto p-4">
            <div class="p-6 max-w-6xl mx-auto">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold mb-4">Task Page</h1>
                    <a href="{{ route('tasks.create') }}">
                        <button class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-md flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>

                            New Task
                        </button>
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    @php
                        $stats = [
                            ['label' => 'Total Tasks', 'count' => count($tasks), 'color' => 'purple'],
                            ['label' => 'Completed Tasks', 'count' => collect($tasks)->where('status', 'done')->count(), 'color' => 'green'],
                            ['label' => 'In Progress', 'count' => collect($tasks)->where('status', 'in_progress')->count(), 'color' => 'blue'],
                            ['label' => 'Overdue', 'count' => collect($tasks)->where('deadline', '<', now())->where('status', '!=', 'done')->count(), 'color' => 'red'],
                        ];
                    @endphp
                    @foreach ($stats as $stat)
                        <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                            <div class="p-6">
                                <div class="flex items-center gap-3 mb-1">
                                    <div class="w-8 h-8 rounded-md bg-{{ $stat['color'] }}-50 flex items-center justify-center">
                                        <svg class="h-6 w-6 text-{{ $stat['color'] }}-600" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M12 6v6l4 2" />
                                        </svg>
                                    </div>
                                    <div class="text-m text-gray-500">{{ $stat['label'] }}</div>
                                </div>
                                <div class="text-2xl font-bold text-center">{{ $stat['count'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Filter
                <div class="bg-white border rounded p-4 mb-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div class="relative col-span-2">
                        <img src="https://cdn-icons-png.flaticon.com/512/4347/4347487.png" alt="Search Icon"
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 opacity-50">
                        <input type="text" placeholder="Search task (title/description)"
                            class="pl-10 border rounded px-3 py-2 w-full">
                    </div>
                    <select class="w-full border rounded px-3 py-2">
                        <option>All Events</option>
                        @foreach(array_unique(array_column($tasks, 'event')) as $event)
                            <option>{{ $event }}</option>
                        @endforeach
                    </select>
                    <select class="w-full border rounded px-3 py-2">
                        <option>All Status</option>
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="done">Done</option>
                    </select>
                    <select class="w-full border rounded px-3 py-2">
                        <option>Assigned to (All)</option>
                        @foreach(array_unique(array_column($tasks, 'assigned_to')) as $user)
                            <option>{{ $user }}</option>
                        @endforeach
                    </select>
                </div> -->

                <!-- Table -->
                <div class="bg-white border rounded p-4">
                    <table class="w-full text-l">
                        <thead>
                            <tr class="border-b font-semibold text-center">
                                <th class="py-2">Task Title</th>
                                <th class="py-2">Related Event</th>
                                <th class="py-2">Assigned to</th>
                                <th class="py-2">Deadline</th>
                                <th class="py-2">Status</th>
                                <th class="py-2">Evidence</th>
                                <th class="py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                @php
                                    // Pastikan kunci 'status' ada sebelum mengaksesnya
                                    $statusClasses = [
                                        'pending' => 'bg-red-100 text-red-800',
                                        'in_progress' => 'bg-yellow-100 text-yellow-800',
                                        'done' => 'bg-green-100 text-green-800',
                                    ];
                                    $badge = isset($task['status']) ? ($statusClasses[$task['status']] ?? 'bg-gray-100 text-gray-800') : 'bg-gray-100 text-gray-800';
                                @endphp
                                <tr class="border-b text-center">
                                    <td class="py-2 text-left">{{ $task['title'] ?? 'N/A' }}</td>
                                    <td class="py-2">{{ $task['event'] ?? 'N/A' }}</td>
                                    <td class="py-2">{{ $task['assigned_to'] ?? 'N/A' }}</td>
                                    <td class="py-2">
                                        {{ isset($task['deadline']) ? \Carbon\Carbon::parse($task['deadline'])->format('d M Y') : 'N/A' }}
                                    </td>
                                    <td class="py-2">
                                        <span class="px-2 py-1 rounded text-xs {{ $badge }}">
                                            {{ isset($task['status']) ? ucfirst(str_replace('_', ' ', $task['status'])) : 'Unknown' }}
                                        </span>
                                    </td>
                                    <td class="py-2">
                                        @if (!empty($task['evidence']))
                                            <a href="{{ $task['evidence'] }}" class="text-blue-500 text-sm" target="_blank">See</a>
                                        @else
                                            <span class="text-gray-500 text-sm">Unavailable</span>
                                        @endif
                                    </td>
                                    <td class="py-2 space-x-2">
                                        @if (isset($task['id']))
                                            <a href="{{ route('tasks.edit', $task['id']) }}" class="text-blue-600 hover:underline">Edit</a>
                                            <form action="{{ route('tasks.destroy', $task['id']) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                            </form>
                                        @else
                                            <span class="text-gray-500 text-sm">No Actions Available</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection