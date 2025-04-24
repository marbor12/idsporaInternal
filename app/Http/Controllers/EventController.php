<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get events from session or initialize with sample data if empty
        $events = session('events', $this->getSampleEvents());
        
        // Get current date for comparison
        $currentDate = date('Y-m-d');
        
        // Split events into upcoming and past
        $upcomingEvents = array_filter($events, function($event) use ($currentDate) {
            return $event['date'] >= $currentDate;
        });
        
        $pastEvents = array_filter($events, function($event) use ($currentDate) {
            return $event['date'] < $currentDate;
        });
        
        return view('events.read', compact('upcomingEvents', 'pastEvents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'category' => 'required|string',
            'description' => 'nullable|string',
        ]);
        
        // Get existing events or initialize
        $events = session('events', []);
        
        // Create new event
        $newEvent = [
            'id' => Str::uuid()->toString(),
            'title' => $request->title,
            'date' => $request->date,
            'time' => $request->time,
            'category' => $request->category,
            'description' => $request->description ?? '',
        ];
        
        // Add to events array
        $events[] = $newEvent;
        
        // Store in session
        session(['events' => $events]);
        
        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $events = session('events', []);
        
        // Find the event by ID
        $event = null;
        foreach ($events as $e) {
            if ($e['id'] === $id) {
                $event = $e;
                break;
            }
        }
        
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event not found!');
        }
        
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $events = session('events', []);
        
        // Find the event by ID
        $event = null;
        foreach ($events as $e) {
            if ($e['id'] === $id) {
                $event = $e;
                break;
            }
        }
        
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event not found!');
        }
        
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'category' => 'required|string',
            'description' => 'nullable|string',
        ]);
        
        $events = session('events', []);
        
        // Update the event
        foreach ($events as $key => $event) {
            if ($event['id'] === $id) {
                $events[$key] = [
                    'id' => $id,
                    'title' => $request->title,
                    'date' => $request->date,
                    'time' => $request->time,
                    'category' => $request->category,
                    'description' => $request->description ?? '',
                ];
                break;
            }
        }
        
        // Store updated events in session
        session(['events' => $events]);
        
        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $events = session('events', []);
        
        // Filter out the event to delete
        $events = array_filter($events, function($event) use ($id) {
            return $event['id'] !== $id;
        });
        
        // Re-index the array
        $events = array_values($events);
        
        // Store updated events in session
        session(['events' => $events]);
        
        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }
    
    /**
     * Get sample events for initial data
     */
    private function getSampleEvents()
    {
        $currentYear = date('Y');
        $currentMonth = date('m');
        
        return [
            [
                'id' => Str::uuid()->toString(),
                'title' => 'Team Meeting',
                'date' => "$currentYear-$currentMonth-12",
                'time' => '10:00',
                'category' => 'webinar',
                'description' => 'Weekly team sync to discuss project progress',
            ],
            [
                'id' => Str::uuid()->toString(),
                'title' => 'Project Deadline',
                'date' => "$currentYear-$currentMonth-15",
                'time' => '09:00',
                'category' => 'other',
                'description' => 'Final submission for the website redesign',
            ],
            [
                'id' => Str::uuid()->toString(),
                'title' => 'Client Presentation',
                'date' => "$currentYear-$currentMonth-18",
                'time' => '14:00',
                'category' => 'seminar',
                'description' => 'Present the final project to the client',
            ],
            [
                'id' => Str::uuid()->toString(),
                'title' => 'Kickoff Meeting',
                'date' => "$currentYear-" . str_pad($currentMonth - 1, 2, '0', STR_PAD_LEFT) . "-25",
                'time' => '09:00',
                'category' => 'workshop',
                'description' => 'Initial project kickoff with the design team',
            ],
            [
                'id' => Str::uuid()->toString(),
                'title' => 'Client Requirements',
                'date' => "$currentYear-" . str_pad($currentMonth - 1, 2, '0', STR_PAD_LEFT) . "-28",
                'time' => '14:30',
                'category' => 'fgd',
                'description' => 'Meeting to gather client requirements and expectations',
            ],
            [
                'id' => Str::uuid()->toString(),
                'title' => 'Design Review',
                'date' => "$currentYear-$currentMonth-05",
                'time' => '11:00',
                'category' => 'workshop',
                'description' => 'Review of initial design concepts with the team',
            ],
        ];
    }
}