@extends('app')

@section('content')
<div class="flex h-screen bg-gray-50">
    @include('sidebar')
    <div class="flex-1 overflow-auto">
        <!-- Header -->
        <div class="bg-white border-b border-gray-200 px-8 py-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Edit Need</h1>
            <a href="{{ route('events.show', $need->event_id) }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Event
            </a>
        </div>

        <!-- Form Content -->
        <div class="max-w-4xl mx-auto p-8">
            <form action="{{ route('needs.update', $need->id) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')
                
                <!-- Event Info Display -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm font-medium text-blue-800">
                            Editing need for event: <strong>{{ $need->event->title ?? 'Event' }}</strong>
                        </span>
                    </div>
                </div>
                
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
                               value="{{ old('title', $need->title) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors @error('title') border-red-500 @enderror"
                               placeholder="Enter need title">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
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
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors appearance-none bg-white @error('category') border-red-500 @enderror">
                                <option value="">Select Category</option>
                                <option value="logistik" {{ old('category', $need->category) == 'logistik' ? 'selected' : '' }}>
                                    Logistik
                                </option>
                                <option value="desain & media" {{ old('category', $need->category) == 'desain & media' ? 'selected' : '' }}>
                                    Desain & Media
                                </option>
                                <option value="dokumentasi & administrasi" {{ old('category', $need->category) == 'dokumentasi & administrasi' ? 'selected' : '' }}>
                                    Dokumentasi & Administrasi
                                </option>
                                <option value="konsumsi & sdm" {{ old('category', $need->category) == 'konsumsi & sdm' ? 'selected' : '' }}>
                                    Konsumsi & SDM
                                </option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        @error('category')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
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
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors resize-vertical @error('description') border-red-500 @enderror"
                              placeholder="Describe the need in detail...">{{ old('description', $need->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Section (if user has permission to change status) -->
                @if(Auth::check() && (Auth::user()->role === 'CEO' || Auth::user()->role === 'PM'))
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Status Management</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Current Status Display -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    Current Status
                                </label>
                                <div class="flex items-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        @if($need->status == 'draft') bg-gray-100 text-gray-800
                                        @elseif($need->status == 'submitted_to_ceo') bg-yellow-100 text-yellow-800
                                        @elseif($need->status == 'approved_by_ceo') bg-green-100 text-green-800
                                        @elseif($need->status == 'rejected_by_ceo') bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $need->status)) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Status Update (for CEO) -->
                            @if(Auth::user()->role === 'CEO' && $need->status === 'submitted_to_ceo')
                                <div class="space-y-2">
                                    <label for="status" class="block text-sm font-medium text-gray-700">
                                        Update Status
                                    </label>
                                    <select name="status" 
                                            id="status"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors appearance-none bg-white">
                                        <option value="submitted_to_ceo" {{ $need->status == 'submitted_to_ceo' ? 'selected' : '' }}>
                                            Keep as Submitted
                                        </option>
                                        <option value="approved_by_ceo">Approve</option>
                                        <option value="rejected_by_ceo">Reject</option>
                                    </select>
                                </div>
                            @elseif(Auth::user()->role === 'PM' && $need->status === 'draft')
                                <div class="space-y-2">
                                    <label for="status" class="block text-sm font-medium text-gray-700">
                                        Submit for Approval
                                    </label>
                                    <select name="status" 
                                            id="status"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors appearance-none bg-white">
                                        <option value="draft" {{ $need->status == 'draft' ? 'selected' : '' }}>
                                            Keep as Draft
                                        </option>
                                        <option value="submitted_to_ceo">Submit to CEO</option>
                                    </select>
                                </div>
                            @endif
                        </div>

                        <!-- Approval Notes -->
                        <div class="mt-6 space-y-2">
                            <label for="approval_notes" class="block text-sm font-medium text-gray-700">
                                Approval Notes
                                @if(Auth::user()->role === 'CEO')
                                    <span class="text-xs text-gray-500">(Add notes for approval/rejection)</span>
                                @else
                                    <span class="text-xs text-gray-500">(Current notes from CEO)</span>
                                @endif
                            </label>
                            <textarea name="approval_notes" 
                                      id="approval_notes" 
                                      rows="3"
                                      @if(Auth::user()->role !== 'CEO') readonly @endif
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors resize-vertical @if(Auth::user()->role !== 'CEO') bg-gray-50 @endif"
                                      placeholder="@if(Auth::user()->role === 'CEO')Add your notes here...@else No notes available @endif">{{ old('approval_notes', $need->approval_notes) }}</textarea>
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('events.show', $need->event_id) }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors">
                        Update Need
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection