<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = ['budget_id', 'submitted_by', 'status'];

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}

