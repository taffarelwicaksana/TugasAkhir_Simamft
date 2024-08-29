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
        Schema::table('ipk_records', function (Blueprint $table) {
            $table->text('ipk_per_semester')->nullable(); // Menambahkan kolom ipk_per_semester
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ipk_records', function (Blueprint $table) {
            $table->dropColumn('ipk_per_semester');
        });
    }
};
