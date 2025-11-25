<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    protected $primaryKey = 'kk_id';
    protected $table = 'keluarga_kk';
    protected $fillable = [
        'kk_nomor', 'kepala_keluarga_warga_id', 'alamat', 'rt', 'rw'
    ];

    public function kepalaKeluarga()
    {
        return $this->belongsTo(Warga::class, 'kepala_keluarga_warga_id', 'warga_id');
    }

    public function anggotaKeluarga()
    {
        return $this->hasMany(AnggotaKeluarga::class, 'kk_id', 'kk_id')->with('warga');
    }

    // ✅ SCOPE UNTUK SEARCH DAN FILTER
    public function scopeSearchAndFilter($query, $search, $filters)
    {
        return $query->when($search, function ($q) use ($search) {
                $q->where('kk_nomor', 'like', "%{$search}%")
                  ->orWhereHas('kepalaKeluarga', function ($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
            })
            ->when(isset($filters['rt']) && $filters['rt'] != '', function ($q) use ($filters) {
                $q->where('rt', $filters['rt']);
            })
            ->when(isset($filters['rw']) && $filters['rw'] != '', function ($q) use ($filters) {
                $q->where('rw', $filters['rw']);
            })
            ->when(isset($filters['anggota_range']) && $filters['anggota_range'] != '', function ($q) use ($filters) {
                $range = $filters['anggota_range'];
                if ($range === '1-3') {
                    $q->has('anggotaKeluarga', '<=', 3);
                } elseif ($range === '4-6') {
                    $q->has('anggotaKeluarga', '>=', 4)->has('anggotaKeluarga', '<=', 6);
                } elseif ($range === '7+') {
                    $q->has('anggotaKeluarga', '>=', 7);
                }
            });
    }

    // ✅ SCOPE UNTUK SORTING
    public function scopeSort($query, $sortBy, $sortOrder)
    {
        return $query->when($sortBy && $sortOrder, function ($q) use ($sortBy, $sortOrder) {
            if ($sortBy === 'kepala_nama') {
                // Sorting by nama kepala keluarga
                $q->join('warga', 'keluarga_kk.kepala_keluarga_warga_id', '=', 'warga.warga_id')
                  ->orderBy('warga.nama', $sortOrder)
                  ->select('keluarga_kk.*');
            } else {
                // Sorting by column langsung di tabel keluarga_kk
                $q->orderBy($sortBy, $sortOrder);
            }
        });
    }

    // ✅ cek ada istri di KK ini
    public function hasIstri(): bool
    {
        return $this->anggotaKeluarga()
            ->where('hubungan', 'Istri')
            ->exists();
    }

    // ✅ cek ada suami di KK ini
    public function hasSuami(): bool
    {
        return $this->anggotaKeluarga()
            ->where('hubungan', 'Suami')
            ->exists();
    }
}
