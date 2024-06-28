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
        Schema::create('data_gurus', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->string('nama_lengkap');
            $table->string('mata_pelajaran');
            $table->string('jabatan');
            $table->string('kelas_ajar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_gurus');
    }
};
