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
        $currentDate = date('Y-m-d');
        $upcomingEvents = $events->where('date', '>', $currentDate);
        $pastEvents = $events->where('date', '<=', $currentDate);

        return view('events.read', compact('upcomingEvents', 'pastEvents'));
    }

    // Menampilkan form untuk membuat event baru (hanya PM)
    public function create()
    {
        if (strtolower(auth()->user()->role) !== 'pm') {
            abort(403, 'Unauthorized');
        }
        return view('events.create');
    }

    // Menyimpan event baru ke database (hanya PM)
    public function store(Request $request)
    {
        if (strtolower(auth()->user()->role) !== 'pm') {
            abort(403, 'Unauthorized');
        }
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

        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    // Menampilkan detail event berdasarkan ID
    public function show($id)
    {
        $event = Events::findOrFail($id);
        return view('events.show', compact('event'));
    }

    // Menampilkan form untuk mengedit event (hanya PM)
    public function edit($id)
    {
        if (strtolower(auth()->user()->role) !== 'pm') {
            abort(403, 'Unauthorized');
        }
        $event = Events::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    // Memperbarui event berdasarkan ID (hanya PM)
    public function update(Request $request, $id)
    {
        if (strtolower(auth()->user()->role) !== 'pm') {
            abort(403, 'Unauthorized');
        }
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

        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }

    // Menghapus event berdasarkan ID (hanya PM)
    public function destroy($id)
    {
        if (strtolower(auth()->user()->role) !== 'pm') {
            abort(403, 'Unauthorized');
        }
        $event = Events::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }
}