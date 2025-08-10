<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_studi_id')->constrained('program_studis')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('nim')->unique();
            $table->string('nama')->nullable();
            $table->string('ipk')->nullable();
            $table->date('tanggal_masuk')->default(DB::raw('(CURRENT_DATE)'));
            $table->date('tanggal_lulus')->nullable();
            $table->boolean('isPutus')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
