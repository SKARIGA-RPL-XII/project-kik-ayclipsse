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
       Schema::create('sertifikat', function (Blueprint $table) {
    $table->id();
    $table->foreignId('verifikasi_id')->constrained('verifikasi')->cascadeOnDelete();
    $table->string('nomor');
    $table->date('tanggal_terbit');
    $table->date('tanggal_berlaku');
    $table->string('file_sertifikat');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikat');
    }
};
