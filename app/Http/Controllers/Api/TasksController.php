<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tasks;
use Illuminate\Http\Request;
use App\Http\Resources\TasksResource;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Tasks::where('approval_status', 'approved')->get();
        return response()->json(["data" => $tasks]);
    }

    public function store(Request $request)
    {
        if ($request->user()->role !== 'COO') {
            return response()->json([
                'status' => 'fail',
                'message' => 'Unauthorized. Only COO can create tasks.'
            ], 403);
        }
        $validated = $request->validate([
            'title'=>'required|string',
            'description'=>'required|string',
            'event_id'=>'required|exists:events,id',
            'assigned_to'=>'required|exists:users,id',
            'due_date'=>'nullable|date',
            'status'=>'nullable|in:pending,in_progress,completed',
        ]);

        $task = Tasks::create($validated);

        return response()->json($task, 201);
    }


    public function show($id)
{
    $task = Tasks::find($id);
    if (!$task) return response()->json(['message' => 'Task not found'], 404);
    return new TasksResource($task);
}

    public function update(Request $request, $id)
    {
        if ($request->user()->role !== 'COO') {
            return response()->json([
                'status' => 'fail',
                'message' => 'Unauthorized. Only COO can update tasks.'
            ], 403);
        }
        $task = Tasks::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        $validated = $request->validate([
            'title'=>'sometimes|required|string',
            'description'=>'sometimes|required|string',
            'event_id'=>'sometimes|required|exists:events,id',
            'assigned_to'=>'sometimes|required|exists:users,id',
            'due_date'=>'sometimes|nullable|date',
            'status'=>'sometimes|nullable|in:pending,in_progress,completed',
        ]);

        $task->update($validated);
        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Tasks::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}