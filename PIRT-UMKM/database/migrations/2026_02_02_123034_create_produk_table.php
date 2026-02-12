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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usaha_id')->constrained('usaha')->cascadeOnDelete();
            $table->string('nama_produk');
            $table->string('image')->nullable();
            $table->text('komposisi');
            $table->integer('berat_bersih');
            $table->string('kemasan');
            $table->date('tanggal_input');
            $table->enum('status', ['disetujui', 'menunggu', 'ditolak'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
