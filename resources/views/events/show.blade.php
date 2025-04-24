@extends('app')

@section('content')
<div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    @include('sidebar')

    <!-- Main Content -->
    <div class="flex-1 overflow-auto p-4">
        <div>
            <!-- Header with Title -->
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold mb-4">Event Details</h1>
                <a href="{{ route('events') }}" class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-600 transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to Events
                </a>
            </div>

            <!-- Event Details -->
            <div class="bg-white border rounded p-6 mb-6">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-xl font-semibold">{{ $event['title'] }}</h2>
                    <div class="flex gap-2">
                        <a href="{{ route('events.edit', $event['id']) }}" class="px-3 py-1 bg-orange-100 text-orange-600 rounded hover:bg-orange-200 transition-colors text-sm font-medium">
                            Edit
                        </a>
                        <form action="{{ route('events.destroy', $event['id']) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200 transition-colors text-sm font-medium">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <p class="text-sm text-gray-500">Date & Time</p>
                        <p>{{ $event['date'] }} at {{ $event['time'] }}</p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-500">Category</p>
                        <p>{{ ucfirst($event['category']) }}</p>
                    </div>
                </div>
                
                <div>
                    <p class="text-sm text-gray-500 mb-2">Description</p>
                    <p>{{ $event['description'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection