<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{

    // Menampilkan daftar event
    public function index(Request $request)
    {
        // Ambil data event dari session, jika tidak ada gunakan data contoh
        $events = session('events', $this->getSampleEvents());

        // Ambil tanggal hari ini
        $currentDate = date('Y-m-d');

        // Pisahkan event menjadi upcoming (mendatang) dan past (sudah berlalu)
        $upcomingEvents = array_filter($events, function ($event) use ($currentDate) {
            return $event['date'] >= $currentDate; // Event yang tanggalnya >= hari ini
        });

        $pastEvents = array_filter($events, function ($event) use ($currentDate) {
            return $event['date'] < $currentDate; // Event yang tanggalnya < hari ini
        });

        // Kirim data ke view
        return view('events.read', compact('upcomingEvents', 'pastEvents'));
    }

    // Menampilkan form untuk membuat event baru
    public function create()
    {
        return view('events.create'); // Tampilkan halaman form create
    }

    // Menyimpan event baru ke session
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
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

        // Ambil data event yang sudah ada di session
        $events = session('events', []);

        // Buat event baru
        $newEvent = [
            'id' => Str::uuid()->toString(),
            'title' => $request->title,
            'date' => $request->date,
            'time' => $request->time,
            'category' => $request->category,
            'venue' => $request->venue,
            'capacity' => $request->capacity,
            'speaker' => $request->speaker,
            'mc' => $request->mc,
            'description' => $request->description ?? '',
        ];

        // Tambahkan event baru ke array
        $events[] = $newEvent;

        // Simpan kembali ke session
        session(['events' => $events]);

        // Redirect ke halaman daftar event dengan pesan sukses
        return redirect()->route('events')->with('success', 'Event created successfully!');
    }

    // Menampilkan detail event berdasarkan ID
    public function show(string $id)
    {
        // Ambil data event dari session
        $events = session('events', []);

        // Cari event berdasarkan ID
        // Pake foreach untuk mencari event berdasarkan ID
        $event = null;
        foreach ($events as $e) {
            if ($e['id'] === $id) {
                $event = $e;
                break;
            }
        }

        // Jika event tidak ditemukan, redirect dengan pesan error
        if (!$event) {
            return redirect()->route('events')->with('error', 'Event not found!');
        }

        // Tampilkan halaman detail event
        return view('events.show', compact('event'));
    }

    // Menampilkan form untuk mengedit event
    public function edit(string $id)
    {
        // Ambil data event dari session
        $events = session('events', []);

        // Cari event berdasarkan ID
        $event = null;
        foreach ($events as $e) {
            if ($e['id'] === $id) {
                $event = $e;
                break;
            }
        }

        // Jika event tidak ditemukan, redirect dengan pesan error
        if (!$event) {
            return redirect()->route('events')->with('error', 'Event not found!');
        }

        // Tampilkan halaman edit event
        return view('events.edit', compact('event'));
    }

    // Memperbarui event berdasarkan ID
    public function update(Request $request, string $id)
    {
        // Validasi input dari form
        $request->validate([
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

        // Ambil data event dari session
        $events = session('events', []);

        // Perbarui event berdasarkan ID
        foreach ($events as $key => $event) {
            if ($event['id'] === $id) {
                $events[$key] = [
                    'id' => $id,
                    'title' => $request->title,
                    'date' => $request->date,
                    'time' => $request->time,
                    'category' => $request->category,
                    'venue' => $request->venue,
                    'capacity' => $request->capacity,
                    'speaker' => $request->speaker,
                    'mc' => $request->mc,
                    'description' => $request->description ?? '',
                ];
                break;
            }
        }

        // Simpan kembali ke session
        session(['events' => $events]);

        // Redirect ke halaman daftar event dengan pesan sukses
        return redirect()->route('events')->with('success', 'Event updated successfully!');
    }

    // Menghapus event berdasarkan ID
    public function destroy(string $id)
    {
        // Ambil data event dari session
        $events = session('events', []);

        // Hapus event berdasarkan ID
        $events = array_filter($events, function ($event) use ($id) {
            return $event['id'] !== $id;
        });

        // Re-index array setelah penghapusan
        $events = array_values($events);

        // Simpan kembali ke session
        session(['events' => $events]);

        // Redirect ke halaman daftar event dengan pesan sukses
        return redirect()->route('events')->with('success', 'Event deleted successfully!');
    }

    // Mengembalikan data contoh untuk event
    private function getSampleEvents()
    {
        $currentYear = date('Y');
        $currentMonth = date('m');

        return [
            [
                'id' => 1,
                'title' => 'Webinar Laravel',
                'date' => '2025-04-30',
                'time' => '10:00',
                'category' => 'Webinar',
                'venue' => 'Online',
                'capacity' => 100,
                'speaker' => 'Dr. Wardani Muhamad, S.T., M.T.',
                'mc' => 'Agvin Amalia',
                'description' => 'Belajar dasar laravel.',
            ],
            [
                'id' => 2,
                'title' => 'Workshop Figma',
                'date' => '2025-03-15',
                'time' => '14:00',
                'category' => 'Workshop',
                'venue' => 'Aula FIT',
                'capacity' => 50,
                'speaker' => 'Robbi Hendriyanto, S.T., M.T.',
                'mc' => 'Stephanie Tarigan',
                'description' => 'Figma dasar bagi pemula.',
            ],
        ];
    }
}