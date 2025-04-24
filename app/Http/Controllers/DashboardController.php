<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data tasks dari session atau gunakan array kosong jika tidak ada
        $tasks = session('tasks', []);

        // Ambil data events dari session atau gunakan array kosong jika tidak ada
        $events = session('events', []);

        // Hitung jumlah tasks dan events
        $totalTasks = count($tasks);
        $totalEvents = count($events);

        // Filter tasks untuk status tertentu
        $recentTasks = array_slice($tasks, 0, 3); // Ambil 3 tasks terbaru

        // Filter events untuk event mendatang
        $currentDate = date('Y-m-d');
        $upcomingEvents = array_filter($events, function ($event) use ($currentDate) {
            return $event['date'] >= $currentDate;
        });

        // Kirim data ke view
        return view('dashboard', compact('totalTasks', 'totalEvents', 'recentTasks', 'upcomingEvents'));
    }
}