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
        Schema::create('file_dokumentasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pembinaan_id');
            $table->unsignedBigInteger('created_by_id');
            $table->text('nama_file');
            $table->enum('tipe_file', ['gambar', 'video', 'pdf', 'word', 'excel', 'powerpoint', 'audio', 'zip', 'rar']);

            $table->foreign('pembinaan_id')->references('id')->on('pembinaans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_dokumentasis');
    }
};
