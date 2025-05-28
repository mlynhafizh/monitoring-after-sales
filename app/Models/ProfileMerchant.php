<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileMerchant extends Model
{
    protected $fillable = [
        'tanggal_gabung',
        'nama_merchant',
        'alamat',
        'no_hp',
        'payroll',
        'deposito', 
        'mtb',
        'giro',
        'kredit_sme', 
        'kredit_kum_kur',
        'mandiri_cm',
        'livin'
    ];
}
