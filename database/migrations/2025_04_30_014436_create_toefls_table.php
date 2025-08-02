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
        Schema::create('toefls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('listening')->nullable();
            $table->string('structure')->nullable();
            $table->string('reading')->nullable();
            $table->string('writting')->nullable();
            $table->string('total_score')->nullable();
            $table->date('tanggal_ujian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toefls');
    }
};
