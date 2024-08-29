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
        Schema::table('prodis', function (Blueprint $table) {
            // Menambahkan kolom id_fakultas sebagai foreign key
            $table->unsignedBigInteger('id_fakultas')->after('nama_prodi');
            
            // Menetapkan foreign key constraint
            $table->foreign('id_fakultas')->references('id')->on('fakultas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prodis', function (Blueprint $table) {
            // Drop foreign key dan kolom id_fakultas
            $table->dropForeign(['id_fakultas']);
            $table->dropColumn('id_fakultas');
        });
    }
};
