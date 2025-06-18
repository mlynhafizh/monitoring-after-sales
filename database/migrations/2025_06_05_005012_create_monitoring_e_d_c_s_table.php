<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('monitoring_edc', function (Blueprint $table) {
            $table->id();
            $table->string('no_rekening');
            $table->date('tanggal');
            $table->date('tanggal_mti');
            $table->string('merchant');
            $table->string('official_name');
            $table->string('alamat')->nullable();
            $table->enum('kd_cabang', ['12600', '12601', '12602','12603','12605', '12606',
                            '12607','12609','12610','12611','12614','12618','12619',
                            '12620','12622','12675',]);
            $table->string('progress');
            $table->string('keterangan_merchant')->nullable();
            $table->string('kategori');
            $table->string('MID')->nullable();
            $table->date('deadline');
            $table->string('status');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_edc');
    }
};
