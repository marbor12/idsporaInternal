<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Http\Request;
use App\Http\Resources\EventResource;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index()
    {
        return EventResource::collection(Events::latest()->get());
    }

    public function show($id)
    {
        $event = Events::find($id);
        
        if (!$event) {
            return response()->json(['message' => 'Event not found.'], 404);
        }
        return new EventResource($event);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'category' => 'required',
            'venue' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'speaker' => 'required|string|max:255',
            'mc' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:draft,submitted,approved,rejected'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $event = Events::create($request->all());
        return new EventResource($event);
    }

    public function update(Request $request, $id)
    {
        $event = Events::find($id);
        if (!$event) {
            return response()->json(['message' => 'Event not found.'], 404);
        }

        $event->update($request->all());
        return new EventResource($event);
    }

    public function destroy($id)
    {
        $event = Events::find($id);
        if (!$event) {
            return response()->json(['message' => 'Event not found.'], 404);
        }

        $event->delete();
        return response()->json(['message' => 'Event deleted successfully.']);
    }
}
