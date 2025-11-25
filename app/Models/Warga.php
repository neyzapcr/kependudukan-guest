<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    /**
     * Scope untuk pencarian dan filter berdasarkan field yang ada di tabel warga
     */
    public function scopeSearchAndFilter(Builder $query, $search = null, $filters = [])
    {
        // Pencarian di nama, no_ktp, dan alamat
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_ktp', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan field yang ada di tabel warga
        $filterableFields = ['jenis_kelamin', 'agama', 'pekerjaan'];

        foreach ($filterableFields as $field) {
            if (!empty($filters[$field])) {
                $query->where($field, $filters[$field]);
            }
        }

        return $query;
    }
}
