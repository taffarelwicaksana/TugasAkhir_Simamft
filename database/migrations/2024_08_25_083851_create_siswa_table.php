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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('NIM')->unique();
            $table->string('no_hp');
            $table->string('nama_orangtua');
            $table->foreignId('prodi_id')->constrained('prodis');
            $table->foreignId('fakultas_id')->constrained('fakultas');
            $table->foreignId('dosbing_id')->constrained('dosbings');
            $table->foreignId('user_id')->constrained('users');
            $table->string('semester_berjalan');
            $table->string('angkatan');
            for ($i = 1; $i <= 8; $i++) {
                $table->float('nilai_s' . $i)->nullable();
                $table->integer('sks_s' . $i)->nullable();
            }
            $table->string('email_sso')->unique();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
