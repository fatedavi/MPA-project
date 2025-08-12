<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'reward',
        'date',
        'status',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function attendees()
{
    return $this->belongsToMany(Employee::class, 'event_attendances');
}

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'event_attendances');
    }
}
