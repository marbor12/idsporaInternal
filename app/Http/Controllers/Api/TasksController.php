<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tasks;
use Illuminate\Http\Request;
use App\Http\Resources\TasksResource;

class TasksController extends Controller
{
    // List semua task yang sudah di-approve CEO
    public function index()
    {
        $tasks = Tasks::where('approval_status', 'approved')->get();
        return TasksResource::collection($tasks);
    }

    // Nonaktifkan pembuatan task manual
    public function store(Request $request)
    {
        return response()->json(['message' => 'Manual task creation is not allowed.'], 403);
    }

    // Detail task
    public function show($id)
    {
        $task = Tasks::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        return new TasksResource($task);
    }

    // Update task
    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'COO') {
            return response()->json(['message' => 'Unauthorized. Only COO can update tasks.'], 403);
        }

        $task = Tasks::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|nullable|string',
            'event_id' => 'sometimes|required|exists:events,id',
            'assigned_to' => 'sometimes|required|exists:users,id',
            'due_date' => 'sometimes|required|date',
            'status' => 'sometimes|required|string',
        ]);

        $task->update($validated);
        return new TasksResource($task);
    }

    // Hapus task (hanya COO)
    public function destroy($id)
    {
        if (auth()->user()->role !== 'COO') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $task = Tasks::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }

    // Approve task
    public function approve($id)
    {
        $task = Tasks::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->approval_status = 'approved';
        $task->save();

        return new TasksResource($task);
    }

    // Reject task
    public function reject($id)
    {
        $task = Tasks::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->approval_status = 'rejected';
        $task->save();

        return new TasksResource($task);
    }
}