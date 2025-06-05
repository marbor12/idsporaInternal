<?php

// app/Http/Resources/FinancialReportResource.php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FinancialReportResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'created_by' => $this->created_by,
            'month' => $this->month,
            'year' => $this->year,
            'status' => $this->status,
            'amount' => $this->amount,
        ];
    }
}
