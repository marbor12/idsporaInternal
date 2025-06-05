<?php

// app/Http/Resources/PaymentResource.php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'request_id' => $this->request_id,
            'paid_by' => $this->paid_by,
            'payment_date' => $this->payment_date,
            'request' => new RequestResource($this->whenLoaded('request')),
        ];
    }
}
