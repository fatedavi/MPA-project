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

    public function attendances()
    {
        return $this->hasMany(EventAttendance::class);
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'event_attendances');
    }
}
