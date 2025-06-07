<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks; 

class TasksController extends Controller
{
    public function index()
    {
        // Ambil data tasks dari sesi, jika tidak ada, gunakan array kosong
        $tasks = Tasks::all(); 
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'event_id' => 'required|integer',
            'assigned_to' => 'required|integer',
            'due_date' => 'required|date',
            'status' => 'required|string',
        ]);
        Tasks::create($validated);
        return redirect()->route('tasks');
    }
    public function edit($id)
    {
        $task = Tasks::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }
    
    public function update(Request $request, $id)
    {
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
        return redirect()->route('tasks');
    }

    public function destroy($id)
    {
        $task = Tasks::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks');
    }
}