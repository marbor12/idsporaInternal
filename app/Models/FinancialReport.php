<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialReport extends Model
{
    protected $fillable = ['created_by', 'month', 'year', 'status', 'amount'];


public function budget()
{
    return $this->belongsTo(Budget::class);
}

public function user()
{
    return $this->belongsTo(User::class, 'created_by');
}
}