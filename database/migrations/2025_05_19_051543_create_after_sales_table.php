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
     Schema::create('after_sales', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal_akuisisi');
        $table->string('merchant');
        $table->date('tanggal_after_sales');
        $table->string('kode_cabang');
        $table->string('nip');
        $table->string('jabatan');
        $table->enum('status_merchant', ['Aktif', 'nonAktif']);
        $table->enum('ada_kendala', ['Ada', 'Tidak Ada']);
        $table->text('kendala')->nullable();
        $table->text('cross_selling')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('after_sales');
    }
};
