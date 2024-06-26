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
        Schema::create('diklat_g_m_d_s_s', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Ubah tipe ID menjadi UUID
            $table->string('seafare_code');
            $table->string('nik');
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin');
            $table->string('pekerjaan');
            $table->string('kewarganegaraan');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kabupaten_kota');
            $table->string('kecamatan');
            $table->string('kelurahan_desa');
            $table->string('kode_pos');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('nama_ibu_kandung');
            $table->string('foto');
            $table->string('no_telp');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diklat_g_m_d_s_s');
    }
};
