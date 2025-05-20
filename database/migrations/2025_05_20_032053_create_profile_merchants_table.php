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
    Schema::create('profile_merchants', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal_gabung');
        $table->string('nama_merchant');
        $table->string('alamat');
        $table->enum('payroll', ['Y', 'N']);
        $table->enum('deposito', ['Y', 'N']);
        $table->enum('mtb', ['Y', 'N']);
        $table->enum('giro', ['Y', 'N']);
        $table->enum('kredit_sme', ['Y', 'N']);
        $table->enum('kredit_kum_kur', ['Y', 'N']);
        $table->enum('mandiri_cm', ['Y', 'N']);
        $table->enum('livin', ['Y', 'N']);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_merchants');
    }
};
