<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'event_id' => $this->event_id,
            'assigned_to' => $this->assigned_to,
            'due_date' => $this->due_date,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
