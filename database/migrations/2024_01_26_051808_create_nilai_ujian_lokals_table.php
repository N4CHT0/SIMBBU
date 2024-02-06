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
        Schema::create('nilai_ujian_lokal', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nilai_teknik_radio');
            $table->string('nilai_service_document');
            $table->string('nilai_pengaturan_radio');
            $table->string('nilai_bahasa_inggris');
            $table->string('nilai_perjanjian_internasional');
            $table->string('nilai_gmdss');
            $table->string('nilai_telephony');
            $table->string('nilai_ibt');
            $table->string('morse');
            $table->string('nilai_pancasila');
            $table->string('nilai_teknik_listrik');
            $table->string('nilai_praktek_service_document');
            $table->string('nilai_praktek_telephony');
            $table->string('nilai_praktek_morse');
            $table->string('nilai_praktek_gmdss');
            $table->uuid('id_users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_ujian_lokal');
    }
};
