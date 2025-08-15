<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Invoice extends Model
{
    protected $fillable = [
        'no_invoice', 'tgl_invoice', 'nama_client', 'alamat_client',
        'kd_admin', 'up', 'nbast', 'nbast2', 'nbast3', 'nbast4', 'nbast5',
        'jenis_no', 'no_fpb', 'no_fpb2', 'no_fpb3', 'no_fpb4', 'no_fpb5',
        'due_date', 'nama_bank', 'an', 'ac', 'no_fp', 'total_invoice',
        'status', 'tgl_paid', 'detail_invoice', 'ttd', 'ttdkwitansi', 'ttdbast', 'ttdbakn'
    ];

    protected $casts = [
        'detail_invoice' => 'array',
        'tgl_invoice' => 'date',
        'due_date' => 'date',
        'tgl_paid' => 'date',
        'total_invoice' => 'decimal:2'
    ];

    // Auto-generate no_invoice saat create dengan format MPA000/INV/d-m-Y
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            if (empty($invoice->no_invoice)) {
                $invoice->no_invoice = self::generateInvoiceNumber();
            }
        });
    }

    // Generate invoice number dengan format MPA000/INV/d-m-Y
    public static function generateInvoiceNumber()
    {
        $today = now();
        $day = $today->format('d');
        $month = $today->format('m');
        $year = $today->format('Y');
        
        // Get next invoice number from database
        $lastInvoice = self::orderBy('id', 'desc')->first();
        
        if ($lastInvoice) {
            // Extract number from last invoice and increment
            preg_match('/MPA(\d+)\/INV/', $lastInvoice->no_invoice, $matches);
            $nextNumber = isset($matches[1]) ? (intval($matches[1]) + 1) : 1;
        } else {
            $nextNumber = 1;
        }
        
        return 'MPA' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT) . '/INV/' . $day . '-' . $month . '-' . $year;
    }

    // Accessor untuk total dari detail items
    public function getTotalFromItemsAttribute()
    {
        if (!$this->detail_invoice) return 0;
        
        return collect($this->detail_invoice)->sum(function ($item) {
            return ($item['qty'] ?? 0) * ($item['harga'] ?? 0);
        });
    }

    // Mutator untuk update total_invoice otomatis
    public function setDetailInvoiceAttribute($value)
    {
        $this->attributes['detail_invoice'] = json_encode($value);
        
        // Update total_invoice otomatis
        if (is_array($value)) {
            $total = collect($value)->sum(function ($item) {
                return ($item['qty'] ?? 0) * ($item['harga'] ?? 0);
            });
            $this->attributes['total_invoice'] = round($total, 2);
        }
    }
}
