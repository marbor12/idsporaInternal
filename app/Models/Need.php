<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    protected $table = 'needs'; 
    protected $fillable = [
        'event_id', 'description', 'status', 'approval_notes', 
    ];

    public function event()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }
}
