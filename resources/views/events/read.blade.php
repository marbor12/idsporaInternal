@extends('app')

@section('content')
<div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    @include('sidebar')

    <!-- Main Content -->
    <div class="flex-1 overflow-auto p-4">
        <div>
            <h1 class="text-2xl font-bold mb-4">Events</h1>
            
            <!-- Month Navigation -->
            <div class="bg-white border rounded p-4 mb-6 flex justify-between items-center">
                <button class="px-3 py-1 border rounded">Previous</button>
                <h2 class="text-lg font-medium">August 2024</h2>
                <button class="px-3 py-1 border rounded">Next</button>
            </div>
            
            <!-- Events List -->
            <div class="bg-white border rounded p-4">
                <h3 class="font-medium mb-4">Upcoming Events</h3>
                
                <div class="space-y-4">
                    <div class="border-b pb-4">
                        <div class="flex justify-between">
                            <div>
                                <h4 class="font-medium">Team Meeting</h4>
                                <p class="text-sm text-gray-500">August 12, 2024 - 10:00 AM</p>
                                <p class="text-sm mt-2">Weekly team sync to discuss project progress</p>
                            </div>
                            <div>
                                <button class="text-blue-500">Edit</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-b pb-4">
                        <div class="flex justify-between">
                            <div>
                                <h4 class="font-medium">Project Deadline</h4>
                                <p class="text-sm text-gray-500">August 15, 2024 - All Day</p>
                                <p class="text-sm mt-2">Final submission for the website redesign</p>
                            </div>
                            <div>
                                <button class="text-blue-500">Edit</button>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between">
                            <div>
                                <h4 class="font-medium">Client Presentation</h4>
                                <p class="text-sm text-gray-500">August 18, 2024 - 2:00 PM</p>
                                <p class="text-sm mt-2">Present the final project to the client</p>
                            </div>
                            <div>
                                <button class="text-blue-500">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
