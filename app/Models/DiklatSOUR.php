<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class DiklatSOUR extends Model
{
    use HasFactory;
    protected $table = 'diklat_s_o_u_r';
    protected $primarykey = "id";
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'nik',
        'npwp',
        'nama_lengkap',
        'jenis_kelamin',
        'jenis_sertifikat_cop',
        'agama',
        'pekerjaan',
        'tempat_lahir',
        'tanggal_lahir',
        'no_telp',
        'alamat',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'rt_rw',
        'kode_pos',
        'status',
        'nama_instansi',
        'nama_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'nama_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'foto',
        'scan_foto_ijazah',
        'scan_foto_akte',
        'scan_foto_npwp',
        'scan_foto_ktp',
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
