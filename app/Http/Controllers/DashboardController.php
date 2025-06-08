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
        $tasks = Tasks::all();
        $events = Events::all();
        $finance = FinancialReport::all();

        $totalTasks = Tasks::where('status', 'in_progress')->count();
        $totalEvents = $events->count();
        $totalRevenue = $finance->where('category', 'revenue')->sum('amount');
        $totalExpenses = $finance->where('category', 'expenses')->sum('amount');
        $recentTasks = $tasks->sortByDesc('deadline')->take(3);
        $currentDate = date('Y-m-d');
        $upcomingEvents = Events::where('date', '>', $currentDate)->get();

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