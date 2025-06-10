<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Models\Events;
use App\Models\User;
use App\Notifications\TaskApprovalNotification;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Tasks::with(['assignedUser', 'event'])->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'COO') {
            abort(403, 'Unauthorized');
        }
        $events = Events::all();
        $users = User::all();
        return view('tasks.create', compact('events', 'users'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'COO') {
            abort(403, 'Unauthorized');
        }
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'event_id' => 'required|integer',
            'assigned_to' => 'required|integer',
            'due_date' => 'required|date',
            'status' => 'required|string',
        ]);
        Tasks::create($validated);
        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        if (auth()->user()->role !== 'COO') {
            abort(403, 'Unauthorized');
        }
        $events = Events::all();
        $users = User::all();
        $task = Tasks::findOrFail($id);

        return view('tasks.edit', compact('task', 'events', 'users'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'COO') {
            abort(403, 'Unauthorized');
        }
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'event_id' => 'required|integer',
            'assigned_to' => 'required|integer',
            'due_date' => 'required|date',
            'status' => 'required|string',
        ]);
        $task = Tasks::findOrFail($id);
        $task->update($validated);
        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'COO') {
            abort(403, 'Unauthorized');
        }
        $task = Tasks::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index');
    }
    public function approve($id)
    {
        if (strtolower(auth()->user()->role) !== 'CEO') {
            abort(403, 'Unauthorized');
        }

        $task = Tasks::findOrFail($id);
        $task->approval_status = 'approved';
        $task->save();
        
        return redirect()->route('tasks.index')->with('success', 'Task approved!');
    }

    public function reject($id)
    {
        if (strtolower(auth()->user()->role) !== 'CEO') {
            abort(403, 'Unauthorized');
        }

        $task = Tasks::findOrFail($id);
        $task->approval_status = 'rejected';
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task rejected!');
    }
}