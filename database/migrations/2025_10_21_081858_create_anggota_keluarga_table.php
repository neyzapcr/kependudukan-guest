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
        Schema::create('anggota_keluarga', function (Blueprint $table) {
            $table->id('anggota_id'); // Primary key
            $table->foreignId('kk_id')->constrained('keluarga_kk')->onDelete('cascade'); // FK ke KK
            $table->foreignId('warga_id')->constrained('warga')->onDelete('cascade'); // FK ke warga
            $table->string('hubungan', 50); // Suami/Istri/Anak/Lainnya
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_keluarga');
    }
};
