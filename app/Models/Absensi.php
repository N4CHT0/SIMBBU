<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensi';
    protected $primarykey = "id";
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'id_user',
        'id_mata_pelajaran',
        'jenis_diklat',
        'status',
        'pertemuan',
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
