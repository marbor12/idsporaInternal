<?php

// app/Http/Resources/RequestResource.php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'budget_id' => $this->budget_id,
            'submitted_by' => $this->submitted_by,
            'status' => $this->status,
            'budget' => new BudgetResource($this->whenLoaded('budget')),
        ];
    }
}