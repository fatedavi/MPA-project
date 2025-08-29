<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IzinSakit extends Model
{
    use HasFactory;

    protected $table = 'izin_sakit';

    protected $fillable = [
        'employee_id',
        'dokter_surat',
        'alasan',
        'status',
        'keterangan_penolakan',
    ];

    // Relasi ke employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

}
