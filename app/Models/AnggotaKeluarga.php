<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggotaKeluarga extends Model
{
    protected $primaryKey = 'anggota_id';
    protected $table = 'anggota_keluarga';
    protected $fillable = ['kk_id', 'warga_id', 'hubungan'];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'kk_id');
    }
}
