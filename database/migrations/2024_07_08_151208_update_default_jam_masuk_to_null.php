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
        Schema::table('rekap_absens', function (Blueprint $table) {
            $table->time('jam_masuk')->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekap_absens', function (Blueprint $table) {
            $table->time('jam_masuk')->useCurrent()->default(null)->change();
        });
    }
};
