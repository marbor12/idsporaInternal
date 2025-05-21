<?php

namespace App\Models;


use App\Http\Controllers\Api\TasksController;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = [
        'title',
        'description',
        'event_id',
        'assigned_to',
        'due_date',
        'status',
    ];
}