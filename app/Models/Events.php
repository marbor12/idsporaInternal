<?php
// app/Models/Events.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events'; // pastikan sesuai dengan nama tabel
    protected $fillable = [
        'title', 'date', 'time', 'category', 'venue', 'capacity', 'speaker', 'mc', 'description'
    ];
}