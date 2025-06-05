<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events; // Pastikan model kamu bernama Events

class EventController extends Controller
{
    // Menampilkan daftar event
    public function index()
    {
        $events = Events::all();
        // pisahkan upcoming & past:
        $currentDate = date('Y-m-d');
        $upcomingEvents = $events->where('date', '>', $currentDate);
        $pastEvents = $events->where('date', '<=', $currentDate);

        return view('events.read', compact('upcomingEvents', 'pastEvents'));
    }

    // Menampilkan form untuk membuat event baru
    public function create()
    {
        return view('events.create');
    }

    // Menyimpan event baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'category' => 'required|string',
            'venue' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'speaker' => 'required|string|max:255',
            'mc' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Events::create($validated);

        return redirect()->route('events')->with('success', 'Event created successfully!');
    }

    // Menampilkan detail event berdasarkan ID
    public function show($id)
    {
        $event = Events::findOrFail($id);
        return view('events.show', compact('event'));
    }

    // Menampilkan form untuk mengedit event
    public function edit($id)
    {
        $event = Events::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    // Memperbarui event berdasarkan ID
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'category' => 'required|string',
            'venue' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'speaker' => 'required|string|max:255',
            'mc' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $event = Events::findOrFail($id);
        $event->update($validated);

        return redirect()->route('events')->with('success', 'Event updated successfully!');
    }

    // Menghapus event berdasarkan ID
    public function destroy($id)
    {
        $event = Events::findOrFail($id);
        $event->delete();

        return redirect()->route('events')->with('success', 'Event deleted successfully!');
    }
}