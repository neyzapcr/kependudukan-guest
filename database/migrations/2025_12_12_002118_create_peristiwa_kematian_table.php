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
        Schema::create('peristiwa_kematian', function (Blueprint $table) {
            $table->id('kematian_id');
            $table->foreignId('warga_id')->constrained('warga', 'warga_id');
            $table->date('tgl_meninggal');
            $table->string('sebab', 100);
            $table->string('lokasi', 100);
            $table->string('no_surat', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peristiwa_kematian');
    }
};
