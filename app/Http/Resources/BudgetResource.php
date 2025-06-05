<?php

// app/Http/Resources/BudgetResource.php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BudgetResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'event_id' => $this->event_id,
            'status' => $this->status,
            'details' => BudgetDetailResource::collection($this->whenLoaded('details')),
        ];
    }
}
