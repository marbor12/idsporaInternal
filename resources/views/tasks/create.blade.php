@extends('app')

@section('content')
<div class="flex h-screen bg-gray-50">
    @include('sidebar')

    <div class="flex-1 overflow-auto p-4">
        <div class="max-w-4xl mx-auto bg-white border rounded shadow p-6 mt-8">
            <h2 class="text-2xl font-bold mb-6">Create New Task</h2>

            <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="title" class="block font-semibold mb-1">Task Title</label>
                    <input type="text" name="title" id="title" class="w-full border rounded px-4 py-2" required>
                </div>

                <div>
                    <label for="event" class="block font-semibold mb-1">Related Event</label>
                    <input type="text" name="event" id="event" class="w-full border rounded px-4 py-2" required>
                </div>

                <div>
                    <label for="assigned_to" class="block font-semibold mb-1">Assigned To</label>
                    <input type="text" name="assigned_to" id="assigned_to" class="w-full border rounded px-4 py-2" required>
                </div>

                <div>
                    <label for="deadline" class="block font-semibold mb-1">Deadline</label>
                    <input type="date" name="deadline" id="deadline" class="w-full border rounded px-4 py-2" required min="{{ date('Y-m-d') }}">
                </div>

                <div>
                    <label for="status" class="block font-semibold mb-1">Status</label>
                    <select name="status" id="status" class="w-full border rounded px-4 py-2" required>
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="done">Done</option>
                    </select>
                </div>

                <div>
                    <label for="evidence" class="block font-semibold mb-1">Evidence (URL - optional)</label>
                    <input type="url" name="evidence" id="evidence" class="w-full border rounded px-4 py-2">
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('tasks') }}" class="text-gray-600 hover:underline mr-4">Cancel</a>
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded">
                        Save Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
