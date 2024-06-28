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
        Schema::create('rekap_absens', function (Blueprint $table) {
            $table->id();
            $table->string('uid_kartu');
            $table->time('jam_masuk');
            $table->string('status_kehadiran');
            $table->date('tanggal_absen');
            $table->timestamps();

            $table->foreign('uid_kartu')->references('uid')->on('data_gurus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_absens');
    }
};
