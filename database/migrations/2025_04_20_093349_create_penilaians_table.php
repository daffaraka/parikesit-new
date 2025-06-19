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
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('indikator_id');
            $table->decimal('nilai', 5, 2);
            $table->string('catatan')->nullable();
            $table->timestamp('tanggal_penilaian');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('formulir_id')->constrained();
            $table->string('evaluasi')->nullable();
            $table->timestamps();

            $table->softDeletes();

            $table->foreign('indikator_id')->references('id')->on('indikators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
