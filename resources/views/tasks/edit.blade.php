@extends('app')

@section('content')
    <div class="flex h-screen bg-gray-50">
        @include('sidebar')

        <div class="flex-1 overflow-auto p-6">
            <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
                <h2 class="text-2xl font-bold mb-6">Edit Task</h2>

                <form action="{{ route('tasks.update', $task['id']) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" value="{{ $task['title'] }}"
                            class="mt-1 block w-full rounded border border-gray-300 px-3 py-2 shadow-sm focus:outline-none focus:ring focus:ring-orange-300"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Event</label>
                        <input type="text" name="event" value="{{ $task['event'] }}"
                            class="mt-1 block w-full rounded border border-gray-300 px-3 py-2 shadow-sm focus:outline-none focus:ring focus:ring-orange-300"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Assigned To</label>
                        <input type="text" name="assigned_to" value="{{ $task['assigned_to'] }}"
                            class="mt-1 block w-full rounded border border-gray-300 px-3 py-2 shadow-sm focus:outline-none focus:ring focus:ring-orange-300"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Deadline</label>
                        <input type="date" name="deadline" value="{{ $task['deadline'] }}"
                            class="mt-1 block w-full rounded border border-gray-300 px-3 py-2 shadow-sm focus:outline-none focus:ring focus:ring-orange-300"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status"
                            class="mt-1 block w-full rounded border border-gray-300 px-3 py-2 shadow-sm focus:outline-none focus:ring focus:ring-orange-300"
                            required>
                            <option value="pending" {{ $task['status'] === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ $task['status'] === 'in_progress' ? 'selected' : '' }}>In Progress
                            </option>
                            <option value="done" {{ $task['status'] === 'done' ? 'selected' : '' }}>Done</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Evidence (URL)</label>
                        <input type="url" name="evidence" value="{{ $task['evidence'] }}"
                            class="mt-1 block w-full rounded border border-gray-300 px-3 py-2 shadow-sm focus:outline-none focus:ring focus:ring-orange-300">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">
                            Update Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection