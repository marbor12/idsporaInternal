<?php

// app/Http/Resources/BudgetDetailResource.php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BudgetDetailResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'budget_id' => $this->budget_id,
            'description' => $this->description,
            'amount' => $this->amount,
        ];
    }
}
