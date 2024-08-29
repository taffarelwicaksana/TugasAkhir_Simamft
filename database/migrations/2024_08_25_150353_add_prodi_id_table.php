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
        Schema::table('dosbings', function (Blueprint $table) {
            // Menambahkan kolom id_fakultas sebagai foreign key
            $table->unsignedBigInteger('id_prodi')->after('NIP');
            
            // Menetapkan foreign key constraint
            $table->foreign('id_prodi')->references('id')->on('prodis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dosbings', function (Blueprint $table) {
            // Drop foreign key dan kolom id_fakultas
            $table->dropForeign(['id_fakultas']);
            $table->dropColumn('id_fakultas');
        });
    }
};
