@extends('app')

@section('content')
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        @include('sidebar')

        <!-- Main Content -->
        <div class="flex-1 overflow-auto p-4">
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold mb-4">Events</h1>
                    <!-- Tombol untuk membuat event baru -->
                    @if(Auth::check() && Auth::user()->role === 'PM')
                        <a href="{{ route('events.create') }}"
                            class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-900 transition-colors flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Create New Event
                        </a>
                    @endif
                </div>

                <!-- Event Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    @php
                        $stats = [
                            [
                                'label' => 'Total Events',
                                'count' => count($upcomingEvents) + count($pastEvents),
                                'color' => 'purple',
                                'icon' => '<path d="M8 2v4M16 2v4M3 10h18M7 21h10a2 2 0 002-2V8a2 2 0 00-2-2H7a2 2 0 00-2 2v11a2 2 0 002 2z" />'
                            ],
                            [
                                'label' => 'Upcoming Events',
                                'count' => count($upcomingEvents),
                                'color' => 'orange',
                                'icon' => '<path d="M8 2v4M16 2v4M3 10h18M7 21h10a2 2 0 002-2V8a2 2 0 00-2-2H7a2 2 0 00-2 2v11a2 2 0 002 2z" /><path d="M15 13h2M15 17h2M11 13h2M11 17h2M7 13h2M7 17h2" />'
                            ],
                            [
                                'label' => 'Past Events',
                                'count' => count($pastEvents),
                                'color' => 'gray',
                                'icon' => '<circle cx="12" cy="12" r="10" /><polyline points="12 6 12 12 16 14" />'
                            ],
                            [
                                'label' => 'This Month',
                                'count' => collect($upcomingEvents)->filter(function ($event) {
                                    return \Carbon\Carbon::parse($event['date'])->month === now()->month;
                                })->count(),
                                'color' => 'green',
                                'icon' => '<rect x="3" y="4" width="18" height="18" rx="2" ry="2" /><line x1="16" y1="2" x2="16" y2="6" /><line x1="8" y1="2" x2="8" y2="6" /><line x1="3" y1="10" x2="21" y2="10" />'
                            ],
                        ];
                    @endphp
                    @foreach ($stats as $stat)
                        <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                            <div class="p-6">
                                <div class="flex items-center gap-3 mb-1">
                                    <div class="w-8 h-8 rounded-md bg-{{ $stat['color'] }}-50 flex items-center justify-center">
                                        <svg class="h-6 w-6 text-{{ $stat['color'] }}-600" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            {!! $stat['icon'] !!}
                                        </svg>
                                    </div>
                                    <div class="text-m text-gray-500">{{ $stat['label'] }}</div>
                                </div>
                                <div class="text-2xl font-bold text-center">{{ $stat['count'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pesan Sukses -->
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Kartu Event Mendatang -->
                <div class="bg-white border rounded p-4 mb-5">
                    <h3 class="font-medium mb-4">Upcoming Events</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse($upcomingEvents as $event)
                            <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                                <div class="p-4">
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-medium">{{ $event['title'] }}</h4>
                                        <div class="flex gap-2">
                                            @if(Auth::check() && Auth::user()->role === 'PM')
                                                <a href="{{ route('events.edit', $event['id']) }}"
                                                    class="px-3 py-1 bg-orange-100 text-orange-600 rounded hover:bg-orange-200 transition-colors text-sm font-medium">
                                                    Edit
                                                </a>
                                                <form action="{{ route('events.destroy', $event['id']) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this event?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-3 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200 transition-colors text-sm font-medium">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">{{ $event['date'] }} - {{ $event['time'] }}</p>
                                    <p class="text-sm mt-2">{{ $event['description'] }}</p>
                                    <div class="mt-3">
                                        <a href="{{ route('events.show', $event['id']) }}"
                                            class="text-sm text-orange-500 hover:text-orange-700">View Details →</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-3 text-center py-4 text-gray-500">
                                No upcoming events found.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Kartu Event yang Sudah Berlalu -->
                <div class="bg-white border rounded p-4">
                    <h3 class="font-medium mb-4">History</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse($pastEvents as $event)
                            <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow bg-white">
                                <div class="p-4">
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-medium">{{ $event['title'] }}</h4>
                                        <div class="flex gap-2">
                                            @if(Auth::check() && Auth::user()->role === 'PM')
                                                <form action="{{ route('events.destroy', $event['id']) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this event?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-3 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200 transition-colors text-sm font-medium">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('events.show', $event['id']) }}"
                                                class="px-3 py-1 bg-green-100 text-green-600 rounded hover:bg-green-200 transition-colors text-sm font-medium">
                                                View
                                            </a>
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