<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class InventorySertifikat extends Model
{
    use HasFactory;
    protected $table = 'inventory_sertifikat';
    protected $primarykey = "id";
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'nama_mata_kuliah',
        'jenis_diklat',
        'id_pengajar',
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
