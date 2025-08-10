<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'event_id',
        'status', // hadir, izin, sakit, alfa
        'check_in',
        'check_out',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
