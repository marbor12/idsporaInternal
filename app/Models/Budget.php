<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = ['event_id', 'status'];

    public function details()
    {
        return $this->hasMany(BudgetDetail::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
