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
                <h1 class="text-2xl font-bold mb-4">Edit Event</h1>
                <a href="{{ route('events') }}" class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-600 transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to Events
                </a>
            </div>

            <!-- Edit Event Form -->
            <div class="bg-white border rounded p-6 mb-6">
                <form action="{{ route('events.update', $event['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Event Title</label>
                            <input type="text" name="title" id="title" value="{{ $event['title'] }}" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select name="category" id="category" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500">
                                <option value="webinar" {{ $event['category'] == 'webinar' ? 'selected' : '' }}>Webinar</option>
                                <option value="seminar" {{ $event['category'] == 'seminar' ? 'selected' : '' }}>Seminar</option>
                                <option value="workshop" {{ $event['category'] == 'workshop' ? 'selected' : '' }}>Workshop</option>
                                <option value="fgd" {{ $event['category'] == 'fgd' ? 'selected' : '' }}>Focus Group Discussion</option>
                                <option value="other" {{ $event['category'] == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <input type="date" name="date" id="date" value="{{ $event['date'] }}" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        
                        <div>
                            <label for="time" class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                            <input type="time" name="time" id="time" value="{{ $event['time'] }}" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500">
                        </div>

                        <div>
                        <label for="venue" class="block text-sm font-medium text-gray-700 mb-1">Event Venue</label>
                            <input type="text" name="venue" id="venue" value="{{ $event['venue'] }}" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500">
                        </div>

                        <div>
                        <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Capacity</label>
                            <input type="text" name="capacity" id="capacity" value="{{ $event['capacity'] }}" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500">
                        </div>

                        <div>
                        <label for="speaker" class="block text-sm font-medium text-gray-700 mb-1">Speaker</label>
                            <input type="text" name="speaker" id="speaker" value="{{ $event['speaker'] }}" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500">
                        </div>

                        <div>
                        <label for="mc" class="block text-sm font-medium text-gray-700 mb-1">Master of Ceremony</label>
                            <input type="text" name="mc" id="mc"  required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" id="description" rows="4" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500">{{ $event['description'] }}</textarea>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('events') }}" class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-600 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 bg-orange-400 text-white rounded-md hover:bg-orange-600 transition-colors">
                            Update Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection