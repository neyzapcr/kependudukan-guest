<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
        return $this->belongsTo(Keluarga::class, 'kk_id', 'kk_id');
    }

    /**
     * Scope SEARCH + FILTER
     */
    public function scopeSearchAndFilter(Builder $query, $search = null, $filters = [])
    {
        // SEARCH
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('hubungan', 'like', "%{$search}%")
                    ->orWhereHas('warga', function ($qq) use ($search) {
                        $qq->where('nama', 'like', "%{$search}%")
                           ->orWhere('no_ktp', 'like', "%{$search}%")
                           ->orWhere('alamat', 'like', "%{$search}%");
                    });
            });
        }

        // FILTER hubungan
        if (!empty($filters['hubungan'])) {
            $hub = strtolower($filters['hubungan']);

            // kalau filter "Suami" → termasuk kepala keluarga laki2 yang punya istri
            if ($hub === 'suami') {
                $query->where(function ($q) {
                    $q->where('hubungan', 'Suami')
                      ->orWhere(function ($qq) {
                          $qq->where('hubungan', 'Kepala Keluarga')
                             ->whereHas('warga', function ($w) {
                                 $w->where('jenis_kelamin', 'L');
                             })
                             ->whereHas('keluarga.anggotaKeluarga', function ($a) {
                                 $a->where('hubungan', 'Istri');
                             });
                      });
                });
            } else {
                $query->where('hubungan', $filters['hubungan']);
            }
        }

        // FILTER via warga
        if (!empty($filters['jenis_kelamin'])) {
            $query->whereHas('warga', function ($q) use ($filters) {
                $q->where('jenis_kelamin', $filters['jenis_kelamin']);
            });
        }

        if (!empty($filters['agama'])) {
            $query->whereHas('warga', function ($q) use ($filters) {
                $q->where('agama', $filters['agama']);
            });
        }

        if (!empty($filters['pekerjaan'])) {
            $query->whereHas('warga', function ($q) use ($filters) {
                $q->where('pekerjaan', 'like', "%{$filters['pekerjaan']}%");
            });
        }

        return $query;
    }
}
