<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'nama_bank',
        'an',
        'ac'
    ];

    // Relasi dengan Invoice (jika diperlukan)
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'nama_bank', 'nama_bank');
    }
}
