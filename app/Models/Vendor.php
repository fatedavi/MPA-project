<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $primaryKey = 'id_vendor';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_vendor',
        'alamat_vendor',
        'kota',
        'up_vendor',
        'no_telp',
        'email_vendor',
    ];
}