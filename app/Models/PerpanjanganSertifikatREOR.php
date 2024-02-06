<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class PerpanjanganSertifikatREOR extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'perpanjangan_sertifikat_r_e_o_r';
    protected $primarykey = "id";
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'no_sertifikat',
        'nik',
        'npwp',
        'nama_lengkap',
        'diklat_asal',
        'tempat_lahir',
        'tanggal_lahir',
        'kewarganegaraan',
        'alamat',
        'agama',
        'no_telp',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'kelurahan_desa',
        'jenis_kelamin',
        'jenis_sertifikat',
        'foto',
        'scan_foto_ijazah',
        'scan_foto_npwp',
        'scan_foto_sertifikat',
        'email',
    ];
    protected static function boot()
    {
        parent::boot();

        // Membuat UUID saat menyimpan model baru
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid();
        });
    }
}
