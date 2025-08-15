<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $primaryKey = 'id_client';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_client',
        'alamat_client',
        'up',
        'upsph',
    ];
}