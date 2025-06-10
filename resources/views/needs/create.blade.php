@extends('app')

@section('content')
<div class="flex h-screen bg-gray-50">
    @include('sidebar')
    <div class="flex-1 overflow-auto">
        <!-- Header -->
        <div class="bg-white border-b border-gray-200 px-8 py-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Create New Need</h1>
            <a href="{{ route('events.show', $event->id) }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Event
            </a>
        </div>

        <!-- Form Content -->
        <div class="max-w-4xl mx-auto p-8">
            <form action="{{ route('needs.store') }}" method="POST" class="space-y-8">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">
                
                <!-- First Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Title -->
                    <div class="space-y-2">
                        <label for="title" class="block text-sm font-medium text-gray-700">
                            Need Title
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                               placeholder="Enter need title">
                    </div>

                    <!-- Category -->
                    <div class="space-y-2">
                        <label for="category" class="block text-sm font-medium text-gray-700">
                            Category
                        </label>
                        <div class="relative">
                            <select name="category" 
                                    id="category" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors appearance-none bg-white">
                                <option value="">Select Category</option>
                                <option value="logistik">Logistik</option>
                                <option value="desain & media">Desain & Media</option>
                                <option value="dokumentasi & administrasi">Dokumentasi & Administrasi</option>
                                <option value="konsumsi & sdm">Konsumsi & SDM</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">
                        Description
                    </label>
                    <textarea name="description" 
                              id="description" 
                              rows="6" 
                              required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors resize-vertical"
                              placeholder="Describe the need in detail..."></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('events.show', $event->id) }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors">
                        Create Need
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection