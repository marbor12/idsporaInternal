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
            
            <!-- Upcoming Events Cards -->
            <div class="bg-white border rounded p-4 mb-5">
                <h3 class="font-medium mb-4">Upcoming Events</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Card 1 -->
                    <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <h4 class="font-medium">Team Meeting</h4>
                                <div>
                                    <button class="px-3 py-1 bg-orange-100 text-orange-600 rounded hover:bg-orange-200 transition-colors text-sm font-medium">
                                        Edit
                                    </button>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">August 12, 2024 - 10:00 AM</p>
                            <p class="text-sm mt-2">Weekly team sync to discuss project progress</p>
                        </div>
                    </div>
                    
                    <!-- Card 2 -->
                    <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <h4 class="font-medium">Project Deadline</h4>
                                <div>
                                    <button class="px-3 py-1 bg-orange-100 text-orange-600 rounded hover:bg-orange-200 transition-colors text-sm font-medium">
                                        Edit
                                    </button>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">August 15, 2024 - All Day</p>
                            <p class="text-sm mt-2">Final submission for the website redesign</p>
                        </div>
                    </div>
                    
                    <!-- Card 3 -->
                    <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <h4 class="font-medium">Client Presentation</h4>
                                <div>
                                    <button class="px-3 py-1 bg-orange-100 text-orange-600 rounded hover:bg-orange-200 transition-colors text-sm font-medium">
                                        Edit
                                    </button>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">August 18, 2024 - 2:00 PM</p>
                            <p class="text-sm mt-2">Present the final project to the client</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- History Events Cards -->
            <div class="bg-white border rounded p-4">
                <h3 class="font-medium mb-4">History</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- History Card 1 -->
                    <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow bg-gray-50">
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <h4 class="font-medium">Kickoff Meeting</h4>
                                <div>
                                    <button class="px-3 py-1 bg-green-100 text-green-600 rounded hover:bg-orange-200 transition-colors text-sm font-medium">
                                        View
                                    </button>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">July 25, 2024 - 9:00 AM</p>
                            <p class="text-sm mt-2">Initial project kickoff with the design team</p>
                        </div>
                    </div>
                    
                    <!-- History Card 2 -->
                    <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow bg-gray-50">
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <h4 class="font-medium">Client Requirements</h4>
                                <div>
                                    <button class="px-3 py-1 bg-green-100 text-green-600 rounded hover:bg-orange-200 transition-colors text-sm font-medium">
                                        View
                                    </button>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">July 28, 2024 - 2:30 PM</p>
                            <p class="text-sm mt-2">Meeting to gather client requirements and expectations</p>
                        </div>
                    </div>
                    
                    <!-- History Card 3 -->
                    <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow bg-gray-50">
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <h4 class="font-medium">Design Review</h4>
                                <div>
                                    <button class="px-3 py-1 bg-green-100 text-green-600 rounded hover:bg-orange-200 transition-colors text-sm font-medium">
                                        View
                                    </button>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">August 5, 2024 - 11:00 AM</p>
                            <p class="text-sm mt-2">Review of initial design concepts with the team</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection