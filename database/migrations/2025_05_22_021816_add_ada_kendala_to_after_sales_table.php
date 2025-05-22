<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up(): void
    {
        Schema::table('after_sales', function (Blueprint $table) {
            $table->string('ada_kendala')->default('Tidak ada')->after('status_merchant');
        });
    }

    public function down(): void
    {
        Schema::table('after_sales', function (Blueprint $table) {
            $table->dropColumn('ada_kendala');
        });
    }
};
