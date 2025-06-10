@extends('app')

@section('content')
    <div class="flex h-screen bg-gray-50">
        @include('sidebar')
        <div class="flex-1 overflow-auto p-4">
            <div class="max-w-6xl mx-auto">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold mb-4">Task Page</h1>
                    @if(Auth::check() && strtolower(Auth::user()->role) === 'coo')
                        <a href="{{ route('tasks.create') }}">
                            <button class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-md flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-5 h-5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                New Task
                            </button>
                        </a>
                    @endif
                </div>

                {{-- Flash Message --}}
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    @php
                        $stats = [
                            ['label' => 'Total Tasks', 'count' => $tasks->count(), 'color' => 'gray'],
                            ['label' => 'Completed Tasks', 'count' => $tasks->where('status', 'completed')->count(), 'color' => 'green'],
                            ['label' => 'In Progress', 'count' => $tasks->where('status', 'in_progress')->count(), 'color' => 'blue'],
                            ['label' => 'Overdue', 'count' => $tasks->where('due_date', '<', now())->where('status', '!=', 'completed')->count(), 'color' => 'red'],
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

                <!-- Table -->
                <div class="bg-white border rounded p-4 overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b font-semibold text-center">
                                <th class="py-2">Task Title</th>
                                <th class="py-2">Related Event</th>
                                <th class="py-2">Assigned to</th>
                                <th class="py-2">Deadline</th>
                                <th class="py-2">Status</th>
                                <th class="py-2">Approval Status</th>
                                <th class="py-2">Evidence</th>
                                <th class="py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $task)
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-red-100 text-red-800',
                                        'in_progress' => 'bg-yellow-100 text-yellow-800',
                                        'completed' => 'bg-green-100 text-green-800',
                                    ];
                                    $badge = $statusClasses[$task->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <tr class="border-b text-center">
                                    <td class="py-2 text-left">{{ $task->title ?? 'N/A' }}</td>
                                    <td class="py-2">
                                        {{ $task->event ? $task->event->title : 'N/A' }}
                                    </td>
                                    <td class="py-2">
                                        {{ $task->assignedUser ? $task->assignedUser->name : 'N/A' }}
                                    </td>
                                    <td class="py-2">
                                        {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : 'N/A' }}
                                    </td>
                                    <td class="py-2">
                                        <span class="px-2 py-1 rounded text-xs {{ $badge }}">
                                            {{ ucfirst(str_replace('_', ' ', $task->status ?? 'Unknown')) }}
                                        </span>
                                    </td>
                                    <td class="py-2">
                                        <span class="px-2 py-1 rounded text-xs
                                                            @if($task->approval_status === 'approved') bg-green-100 text-green-800
                                                            @elseif($task->approval_status === 'rejected') bg-red-100 text-red-800
                                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($task->approval_status ?? 'waiting') }}
                                        </span>
                                    </td>
                                    <td class="py-2">
                                        @if (!empty($task->evidence))
                                            <a href="{{ $task->evidence }}" class="text-blue-500 text-sm" target="_blank">See</a>
                                        @else
                                            <span class="text-gray-500 text-sm">Unavailable</span>
                                        @endif
                                    </td>
                                    <td class="py-2 space-x-2">
                                        @if(Auth::check() && strtolower(Auth::user()->role) === 'coo')
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-600 hover:underline">
                                                Edit
                                            </a>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                            </form>
                                        @elseif(Auth::check() && Auth::user()->role === 'CEO')
                                            @if($task->approval_status === 'waiting')
                                                <form action="{{ route('tasks.approve', $task->id) }}" method="POST" class="inline"
                                                    style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="text-green-600 hover:underline">Approve</button>
                                                </form>
                                                <form action="{{ route('tasks.reject', $task->id) }}" method="POST" class="inline"
                                                    style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="text-red-600 hover:underline">Reject</button>
                                                </form>
                                            @else
                                                <span class="text-gray-400 text-xs">
                                                    {{ ucfirst($task->approval_status) }}
                                                </span>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-gray-500">No recent tasks found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection