<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $table = 'salaries';

    /**
     * Kolom yang boleh diisi secara mass assignment
     */
    protected $fillable = [
        'employee_id',
        'month',
        'year',
        'base_salary',
        'total_bonus',
        'total_event_reward',
        'total_cut',
        'potongan_cuti',
        'total_salary',
        'status',
    ];

    /**
     * Relasi Salary ke Employee
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
