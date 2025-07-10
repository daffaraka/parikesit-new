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
        Schema::create('dokumentasi_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('undangan'); // Untuk PDF Undangan
            $table->string('daftar_hadir'); // Untuk PDF Daftar Hadir
            $table->string('materi'); // Text Materi
            $table->string('notula'); // Untuk PDF Notula
            $table->string('media'); // Gambar
            $table->unsignedBigInteger('formulir_id');
            $table->foreign('formulir_id')->references('id')->on('formulirs')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumentasi_kegiatans');
    }
};
