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
        Schema::create('akreditasi_program_studi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_studi_id')->constrained('program_studis')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('akreditasi_id')->constrained('akreditasis')->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('tanggal_berlaku');
            $table->date('tanggal_berakhir');
            $table->string('nomor_sk');
            $table->boolean('is_internasional')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akreditasi_program_studi');
    }
};
