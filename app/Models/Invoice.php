<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Invoice extends Model
{
    protected $fillable = [
        'no_invoice', 'tgl_invoice', 'hdeskripsi', 'nama_client', 'alamat_client',
        'kd_admin', 'up', 'nbast', 'nbast2', 'nbast3', 'nbast4', 'nbast5',
        'jenis_no', 'no_fpb', 'no_fpb2', 'no_fpb3', 'no_fpb4', 'no_fpb5',
        'due_date', 'nama_bank', 'an', 'ac', 'no_fp', 'total_invoice',
        'status', 'tgl_paid', 'ttd', 'ttdkwitansi', 'ttdbast', 'ttdbakn'
    ];

    // Auto-generate no_invoice saat create
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            if (empty($invoice->no_invoice)) {
                $lastId = self::max('id') + 1;
                $invoice->no_invoice = 'INV' . str_pad($lastId, 5, '0', STR_PAD_LEFT);
            }
        });
    }
}
