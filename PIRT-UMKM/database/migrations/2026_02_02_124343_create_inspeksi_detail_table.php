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
       Schema::create('inspeksi_detail', function (Blueprint $table) {
    $table->id();
    $table->foreignId('inspeksi_id')->constrained('inspeksi')->cascadeOnDelete();
    $table->foreignId('variabel_id')->constrained('variabel')->cascadeOnDelete();
    $table->enum('jawaban', ['ya', 'tidak']);
    $table->integer('nilai');
    $table->integer('bobot');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspeksi_detail');
    }
};
