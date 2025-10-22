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
        Schema::create('keluarga_kk', function (Blueprint $table) {
            $table->id('kk_id');
            $table->string('kk_nomor', 30)->unique();
            $table->foreignId('kepala_keluarga_warga_id')->constrained('warga', 'warga_id');
            $table->text('alamat');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluarga_kk');
    }
};
