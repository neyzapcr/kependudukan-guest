<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $table = 'warga';
    protected $primaryKey = 'warga_id';
    protected $fillable = [
        'no_ktp', 'nama', 'jenis_kelamin', 'agama',
        'pekerjaan', 'telp', 'email', 'alamat'
    ];

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'kk_id');
    }

    public function kelahiran()
    {
        return $this->hasMany(Kelahiran::class, 'warga_id');
    }
}
