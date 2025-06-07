<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\Tasks;
use App\Models\FinancialReport;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data dari database
        $tasks = Tasks::all();
        $events = Events::all();
        $finance = FinancialReport::all();

        // Hitung jumlah tasks dan events

        $totalTasks = Tasks::where('status', 'in_progress')->count();
        $totalEvents = $events->count();

        // Hitung total pendapatan dari finance
        $totalRevenue = $finance->where('category', 'revenue')->sum('amount');

        // Hitung total pengeluaran dari finance
        $totalExpenses = $finance->where('category', 'expenses')->sum('amount');

        // Filter tasks terbaru (misal berdasarkan deadline)
        $recentTasks = $tasks->sortByDesc('deadline')->take(3);

        // Filter events untuk event mendatang
        $currentDate = date('Y-m-d');
        // $upcomingEvents = $events->where('date', '>', $currentDate);
        $upcomingEvents = Events::where('date', '>', $currentDate)->get();


        // Kirim data ke view
        return view('dashboard', compact(
            'tasks',
            'totalTasks',
            'totalEvents',
            'totalRevenue',
            'recentTasks',
            'upcomingEvents',
            'totalExpenses'
        ));
    }
}