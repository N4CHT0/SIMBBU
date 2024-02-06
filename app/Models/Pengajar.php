<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Pengajar extends Model
{
    use HasFactory;
    protected $table = 'pengajar';
    protected $primarykey = "id";
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'nama_pengajar',
        'id_user',
        'id_mata_pelajaran',
        'no_telp',
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
