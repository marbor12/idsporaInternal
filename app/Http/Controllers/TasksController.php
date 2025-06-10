<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Models\Events;
use App\Models\User;

class TasksController extends Controller
{
    // COO dan CEO bisa melihat semua task yang sudah di-approve CEO
    public function index()
    {
        $tasks = Tasks::where('approval_status', 'approved')->get();
        return view('tasks.index', compact('tasks'));
    }

    // COO: Form tambah task manual (opsional, biasanya task otomatis dari kebutuhan)
    public function create()
    {
        if (auth()->user()->role !== 'COO') {
            abort(403, 'Unauthorized');
        }
        $events = Events::all();
        $users = User::all();
        return view('tasks.create', compact('events', 'users'));
    }

    // COO: Simpan task manual (opsional)
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
        $validated['approval_status'] = 'approved'; // Task manual langsung di-approve COO
        Tasks::create($validated);
        return redirect()->route('tasks.index')->with('success', 'Task created!');
    }

    // COO: Edit task (assign PIC, ubah status, dsb)
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

    // COO: Update task (assign PIC, ubah status, dsb)
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
        return redirect()->route('tasks.index')->with('success', 'Task updated!');
    }

    // COO: Hapus task
    public function destroy($id)
    {
        if (auth()->user()->role !== 'COO') {
            abort(403, 'Unauthorized');
        }
        $task = Tasks::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted!');
    }

    // CEO: Approve task (jika ada approval manual)
    public function approve($id)
    {
        if (strtolower(auth()->user()->role) !== 'ceo') {
            abort(403, 'Unauthorized');
        }

        $task = Tasks::findOrFail($id);
        $task->approval_status = 'approved';
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task approved!');
    }

    // CEO: Reject task (jika ada approval manual)
    public function reject($id)
    {
        if (strtolower(auth()->user()->role) !== 'ceo') {
            abort(403, 'Unauthorized');
        }

        $task = Tasks::findOrFail($id);
        $task->approval_status = 'rejected';
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task rejected!');
    }
}