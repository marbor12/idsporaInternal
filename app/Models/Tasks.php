<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = [
        'title',
        'description',
        'event_id',
        'assigned_to',
        'due_date',
        'status',
    ];

    // Relasi opsional
    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function event()
    {
        return $this->belongsTo(Events::class);
    }
}
