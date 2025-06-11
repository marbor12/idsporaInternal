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
        'approval_status', 
        'need_id',
    ];

    // Relasi opsional

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }


    public function event()
    {
        return $this->belongsTo(Events::class);
    }

    public function need()
    {
        return $this->belongsTo(Need::class, 'need_id');
    }
}
