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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Ubah tipe ID menjadi UUID
            $table->string('nip');
            $table->string('nama');
            $table->string('jabatan');
            $table->string('divisi');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('no_telp');
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
