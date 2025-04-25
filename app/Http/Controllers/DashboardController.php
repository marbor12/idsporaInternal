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

        // Ambil data finance dari session atau gunakan array kosong jika tidak ada
        $finance = session('transactions', []);

        // Hitung jumlah tasks dan events
        $totalTasks = count($tasks);
        $totalEvents = count($events);

        // Hitung total pendapatan dari finance
        $totalRevenue = collect($finance)->where('category', 'revenue')->sum('amount');

        // Hitung total pengeluaran dari finance
        $totalExpenses = collect($finance)->where('category', 'expenses')->sum('amount');

        // Filter tasks untuk status tertentu
        $recentTasks = collect($tasks)->sortByDesc('deadline')->take(3);

        // Filter events untuk event mendatang
        $currentDate = date('Y-m-d');
        $upcomingEvents = array_filter($events, function ($event) use ($currentDate) {
        return $event['date'] >= $currentDate;
        });

        $totalEvents = count($events);

        // Kirim data ke view
        return view('dashboard', compact('tasks', 'totalTasks', 'totalEvents', 'totalRevenue', 'recentTasks', 'upcomingEvents', 'totalExpenses'));
    }
}