<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    protected $primaryKey = 'kk_id';
    protected $table      = 'keluarga_kk';
    protected $fillable   = [
        'kk_nomor', 'kepala_keluarga_warga_id', 'alamat', 'rt', 'rw',
    ];

    public function kepalaKeluarga()
    {
        return $this->belongsTo(Warga::class, 'kepala_keluarga_warga_id');
    }

    public function anggotaKeluarga()
    {
        return $this->hasMany(AnggotaKeluarga::class, 'kk_id', 'kk_id')->with('warga');
    }

}
