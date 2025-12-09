<?php
// app/Models/Kelahiran.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelahiran extends Model
{
    use HasFactory;

    protected $table      = 'peristiwa_kelahiran';
    protected $primaryKey = 'kelahiran_id';
    public $incrementing  = true;
    protected $keyType    = 'int';

    protected $fillable = [
        'warga_id',
        'tgl_lahir',
        'tempat_lahir',
        'ayah_warga_id',
        'ibu_warga_id',
        'no_akta',
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
    ];

    // Relasi ke data warga (anak)
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    // Relasi ke ayah
    public function ayah()
    {
        return $this->belongsTo(Warga::class, 'ayah_warga_id', 'warga_id');
    }

    // Relasi ke ibu
    public function ibu()
    {
        return $this->belongsTo(Warga::class, 'ibu_warga_id', 'warga_id');
    }

    public function scopeSearch($query, $search = null)
    {
        if (! $search) {
            return $query;
        }

        return $query->where(function ($q) use ($search) {
            $q->where('no_akta', 'like', "%{$search}%")
                ->orWhere('tempat_lahir', 'like', "%{$search}%")
                ->orWhereHas('warga', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })
                ->orWhereHas('ayah', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })
                ->orWhereHas('ibu', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
        });
    }

    /**
     * Scope untuk filter tambahan
     * contoh parameter yang didukung:
     * - tempat_lahir
     * - tahun (tahun tgl_lahir)
     * - bulan (bulan tgl_lahir)
     */
    public function scopeFilter($query, array $filters = [])
    {
        return $query
            ->when($filters['tempat_lahir'] ?? null, function ($q, $tempat) {
                $q->where('tempat_lahir', 'like', "%{$tempat}%");
            })
            ->when($filters['tahun'] ?? null, function ($q, $tahun) {
                $q->whereYear('tgl_lahir', $tahun);
            })
            ->when($filters['bulan'] ?? null, function ($q, $bulan) {
                $q->whereMonth('tgl_lahir', $bulan);
            });
    }

}
