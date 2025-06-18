<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringEDC extends Model
{
    use HasFactory;

    protected $table = 'monitoring_edc';
    
    protected $fillable = [
        'no_rekening',
        'tanggal_mti',
        'merchant',
        'official_name',
        'alamat',
        'kd_cabang',
        'progress',
        'keterangan_merchant',
        'kategori',
        'MID',
        'deadline',
        'status',
        'keterangan'
    ];
}
