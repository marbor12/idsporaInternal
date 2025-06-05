<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['request_id', 'paid_by', 'payment_date'];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }
}
