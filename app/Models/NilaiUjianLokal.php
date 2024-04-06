<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class NilaiUjianLokal extends Model
{
    use HasFactory;
    protected $table = 'nilai_ujian_lokal';
    protected $primarykey = "id";
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'nilai_teknik_radio',
        'nilai_service_document',
        'nilai_pengaturan_radio',
        'nilai_bahasa_inggris',
        'nilai_perjanjian_internasional',
        'nilai_gmdss',
        'nilai_naveka',
        'nilai_telephony',
        'nilai_ibt',
        'nilai_morse',
        'nilai_pancasila',
        'nilai_teknik_listrik',
        'nilai_praktek_service_document',
        'nilai_praktek_telephony',
        'nilai_praktek_morse',
        'nilai_praktek_gmdss',
        'id_user',
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
