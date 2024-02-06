<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Prasarana extends Model
{
    use HasFactory;
    protected $table = 'prasarana';
    protected $primarykey = "id";
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'nama_barang',
        'kondisi_barang',
        'jumlah_barang',
        'status_barang',
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
