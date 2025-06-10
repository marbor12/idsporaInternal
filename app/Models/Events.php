<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable = [
        'title', 'date', 'time', 'category', 'venue',
        'capacity', 'speaker', 'mc', 'description', 'status',
    ];
}
