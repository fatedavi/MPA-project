<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_cuti';

    protected $fillable = [
        'employee_id',
        'day',
        'tanggal',
        'description',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
