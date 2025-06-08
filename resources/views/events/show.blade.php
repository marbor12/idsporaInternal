@extends('app')

@section('content')
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        @include('sidebar')

        <!-- Main Content -->
        <div class="flex-1 overflow-auto p-4">
            <div>
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Event Details</h1>
                    <a href="{{ route('events.index') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors flex items-center gap-2 shadow-sm">
                        <!-- Tombol kembali ke halaman daftar event -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        Back to Events
                    </a>
                </div>

                <!-- Detail Event Card -->
                <div class="bg-white border rounded-lg shadow-sm overflow-hidden">
                    <!-- Header Event dengan Background -->
                    <div class="bg-gradient-to-r from-orange-500 to-orange-400 p-6 relative">
                        <div class="absolute top-4 right-4 flex gap-2">
                            <!-- Tombol Edit -->
                            @if(Auth::check() && Auth::user()->role === 'pm')
                                <a href="{{ route('events.edit', $event['id']) }}"
                                    class="px-4 py-2 bg-white text-orange-600 rounded-md hover:bg-orange-50 transition-colors text-sm font-medium shadow-sm flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                                <!-- Tombol Hapus -->
                                <form action="{{ route('events.destroy', $event['id']) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this event?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-2 bg-white text-red-600 rounded-md hover:bg-red-50 transition-colors text-sm font-medium shadow-sm flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </div>

                        <!-- Informasi Status Event -->
                        <div class="mt-4 text-white">
                            <h2 class="text-2xl font-bold mb-2">{{ $event['title'] }}</h2>

                            <!-- Event Status Badge -->
                            @php
                                $eventDate = \Carbon\Carbon::parse($event['date']);
                                $now = \Carbon\Carbon::now();

                                //Status Event
                                if ($eventDate->isFuture()) {
                                    $statusClass = 'bg-green-500';
                                    $statusText = 'Upcoming';
                                } elseif ($eventDate->isToday()) {
                                    $statusClass = 'bg-blue-500';
                                    $statusText = 'Today';
                                } else {
                                    $statusClass = 'bg-gray-500';
                                    $statusText = 'Past';
                                }
                            @endphp

                            <span
                                class="inline-block {{ $statusClass }} text-white text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $statusText }}
                            </span>

                            <!-- Tanggal dan Waktu Event -->
                            <div class="flex items-center mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $event['date'] }} at {{ $event['time'] }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Konten Detail Event -->
                    <div class="p-6">
                        <!-- Informasi Event -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700">Category</span>
                                </div>
                                <p class="text-gray-800 font-semibold">{{ ucfirst($event['category']) }}</p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700">Venue</span>
                                </div>
                                <p class="text-gray-800 font-semibold">{{ $event['venue'] }}</p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700">Capacity</span>
                                </div>
                                <p class="text-gray-800 font-semibold">{{ $event['capacity'] }} people</p>
                            </div>
                        </div>

                        <!-- Event Team -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-4 text-gray-800 border-b pb-2">Event Team</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-start">
                                    <div class="bg-orange-100 rounded-full p-2 mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Speaker</p>
                                        <p class="font-medium">{{ $event['speaker'] }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="bg-orange-100 rounded-full p-2 mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Master of Ceremony</p>
                                        <p class="font-medium">{{ $event['mc'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Event Description -->
                        <div>
                            <h3 class="text-lg font-semibold mb-3 text-gray-800 border-b pb-2">Description</h3>
                            <div class="prose max-w-none text-gray-700">
                                <p>{{ $event['description'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-8">

                <h2 class="text-xl font-semibold mb-4">Kebutuhan Event</h2>
                <table class="w-full border mb-4">
                    <thead>
                        <tr>
                            <th>Kebutuhan</th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($event->needs as $need)
                            <tr>
                                <td>{{ $need->description }}</td>
                                <td>
                                    <span class="px-2 py-1 rounded text-xs
                                                    @if($need->status == 'draft') bg-gray-100 text-gray-800
                                                    @elseif($need->status == 'submitted_to_ceo') bg-yellow-100 text-yellow-800
                                                    @elseif($need->status == 'approved_by_ceo') bg-green-100 text-green-800
                                                    @elseif($need->status == 'rejected_by_ceo') bg-red-100 text-red-800
                                                    @endif">
                                        {{ ucfirst(str_replace('_', ' ', $need->status)) }}
                                    </span>
                                </td>
                                <td>{{ $need->approval_notes }}</td>
                                <td>
                                    @if(Auth::user()->role == 'pm' && $need->status == 'draft')
                                        <form action="{{ route('needs.submitToCeo', $need->id) }}" method="POST">
                                            @csrf
                                            <button class="px-3 py-1 bg-blue-600 text-white rounded text-xs">Ajukan ke CEO</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection