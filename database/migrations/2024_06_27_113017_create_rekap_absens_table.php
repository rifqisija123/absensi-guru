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
        Schema::create('rekap_absens', function (Blueprint $table) {
            $table->id();
            $table->string('uid_kartu');
            $table->timestamp('tanggal_absen')->useCurrent();
            $table->timestamp('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->enum('status_kehadiran', ['Hadir', 'Izin', 'Sakit'])->default('Hadir');
            $table->morphs('absenable');
            $table->timestamps();

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
