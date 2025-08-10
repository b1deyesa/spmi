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
        Schema::create('fakultas_penetapans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fakultas_id')->constrained('fakultas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('penetapan_id')->constrained('penetapans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('status_pengaturan')->default(false);
            $table->text('tautan')->nullable();
            $table->boolean('status_verifikasi')->default(false);
            $table->boolean('status_dokumen')->default(false);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fakultas_penetapans');
    }
};
