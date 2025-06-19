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
        Schema::create('pembinaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('peserta_id');
            $table->unsignedBigInteger('penjadwalan_id');
            // $table->
            $table->string('judul_pembinaan');
            $table->date('tanggal_pembinaan');
            $table->text('ringkasan_pembinaan');
            $table->string('bukti_pembinaan');
            $table->string('pemateri');

            $table->unsignedBigInteger('created_by');

            $table->foreign('profile_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('peserta_id')->references('id')->on('peserta_pembinaans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('penjadwalan_id')->references('id')->on('penjadwalans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembinaans');
    }
};
