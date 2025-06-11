<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetDetail extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['budget_id', 'description', 'amount'];

    public function budget()
    {
        return $this->belongsTo(Budget::class,"budget_id", "id");
    }
}