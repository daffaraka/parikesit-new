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
            $table->string('dokumentasi');
            $table->string('keterangan');
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
