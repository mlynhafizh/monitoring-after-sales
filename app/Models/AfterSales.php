<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AfterSales extends Model
{
    protected $fillable = [
    'tanggal_akuisisi',
    'merchant',
    'tanggal_after_sales',
    'kode_cabang',
    'nip',
    'jabatan',
    'status_merchant',
    'kendala',
    'cross_selling',
    ];
    public function up()
    {
        Schema::create('after_sales', function (Blueprint $table) {
            $table->id();
            $table->string('nama_merchant');
            $table->string('status_merchant');
            $table->string('kendala');
            $table->timestamps();
        });
    }
    public $timestamps = true;

    protected $casts = [
        'tanggal_akuisisi' => 'date',
        'tanggal_after_sales' => 'date',
    ];
}
