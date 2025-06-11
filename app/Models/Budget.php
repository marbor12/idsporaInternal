<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['event_id'];

    public function details()
    {
        return $this->hasMany(BudgetDetail::class,"budget_id", "id");
    }

}