<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpkRecordsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ipk_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas');
            $table->decimal('ipk', 4, 2)->nullable();  // Menyimpan IPK dengan 2 desimal
            $table->decimal('total_sks', 5, 2)->nullable();  // Menyimpan total SKS
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ipk_records', function (Blueprint $table) {
            //
        });
    }
};
