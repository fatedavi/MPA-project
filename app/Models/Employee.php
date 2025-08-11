<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'emergency_phone',
        'address',
        'nik',
        'ktp',
        'kk',
        'ijazah',
        'cv',
        'position',
        'base_salary',
        'email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
