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
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id');                       // Primary key dengan nama media_id
            $table->string('ref_table', 50);              // Nama tabel yang mereferensi
            $table->unsignedBigInteger('ref_id');         // ID dari tabel yang mereferensi
            $table->string('file_name', 255);             // Nama file yang diupload
            $table->string('caption', 255)->nullable();   // Keterangan file
            $table->string('mime_type', 100)->nullable(); // Tipe file
            $table->integer('sort_order')->default(1);    // Urutan jika ada banyak file
            $table->timestamps();


            $table->index(['ref_table', 'ref_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
