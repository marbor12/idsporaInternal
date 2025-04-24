@extends('app')

@section('content')
<div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    @include('sidebar')

    <!-- Main Content -->
    <div class="flex-1 overflow-auto p-4">
        <div>
            <!-- Header with Title and Create Button -->
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold mb-4">Events</h1>
                <a href="{{ route('events.create') }}" class="px-4 py-2 bg-orange-400 text-white rounded-md hover:bg-orange-600 transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Create New Event
                </a>
            </div>

            <!-- Month Navigation and Filters -->
            <div class="bg-white border rounded p-4 mb-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Month/Year Selection -->
                    <div class="flex items-center gap-3 flex-wrap">
                        <div class="flex items-center border rounded">
                            <button class="px-3 py-1 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                                Previous
                            </button>

                            <div class="flex border-l border-r">
                                <select class="px-3 py-1 border-r bg-white focus:outline-none">
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8" selected>August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>

                                <select class="px-3 py-1 bg-white focus:outline-none">
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024" selected>2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                </select>
                            </div>

                            <button class="px-3 py-1 flex items-center">
                                Next
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>

                        <button class="px-3 py-1 border rounded bg-white hover:bg-gray-100 transition-colors">
                            Today
                        </button>
                    </div>

                    <!-- Search and Filters -->
                    <div class="flex items-center gap-2 ml-auto">
                        <div class="relative">
                            <input type="text" placeholder="Search events..." class="pl-8 pr-3 py-1 border rounded w-full md:w-64 focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 absolute left-2.5 top-1/2 transform -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>

                        <select class="px-3 py-1 border rounded bg-white focus:outline-none">
                            <option value="">All Categories</option>
                            <option value="webinar">Webinar</option>
                            <option value="seminar">Seminar</option>
                            <option value="workshop">Workshop</option>
                            <option value="fgd">Focus Group Discussion</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
            </div>

            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <!-- Upcoming Events Cards -->
            <div class="bg-white border rounded p-4 mb-5">
                <h3 class="font-medium mb-4">Upcoming Events</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($upcomingEvents as $event)
                    <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <h4 class="font-medium">{{ $event['title'] }}</h4>
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
                            <p class="text-sm text-gray-500 mt-1">{{ $event['date'] }} - {{ $event['time'] }}</p>
                            <p class="text-sm mt-2">{{ $event['description'] }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-4 text-gray-500">
                        No upcoming events found.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- History Events Cards -->
            <div class="bg-white border rounded p-4">
                <h3 class="font-medium mb-4">History</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($pastEvents as $event)
                    <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow bg-white">
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <h4 class="font-medium">{{ $event['title'] }}</h4>
                                <div class="flex gap-2">
                                    <a href="{{ route('events.show', $event['id']) }}" class="px-3 py-1 bg-green-100 text-green-600 rounded hover:bg-green-200 transition-colors text-sm font-medium">
                                        View
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
                            <p class="text-sm text-gray-500 mt-1">{{ $event['date'] }} - {{ $event['time'] }}</p>
                            <p class="text-sm mt-2">{{ $event['description'] }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-4 text-gray-500">
                        No past events found.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection