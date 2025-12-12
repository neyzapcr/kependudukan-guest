<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pindah extends Model
{
    protected $primaryKey = 'pindah_id';
    protected $table      = 'peristiwa_pindah';
    protected $fillable   = [
        'warga_id',
        'tgl_pindah',
        'alamat_tujuan',
        'alasan',
        'no_surat',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }

    /**
     * Scope untuk pencarian (search)
     * Mencari di: nama warga, alamat_tujuan, alasan, no_surat
     */
    public function scopeSearch($query, $keyword)
    {
        if (!$keyword) {
            return $query;
        }

        return $query->where(function ($q) use ($keyword) {
            $q->whereHas('warga', function ($qw) use ($keyword) {
                $qw->where('nama', 'like', "%{$keyword}%");
            })
            ->orWhere('alamat_tujuan', 'like', "%{$keyword}%")
            ->orWhere('alasan', 'like', "%{$keyword}%")
            ->orWhere('no_surat', 'like', "%{$keyword}%");
        });
    }

    /**
     * Scope untuk filter: alamat_tujuan, tahun, bulan
     */
    public function scopeFilter($query, $filters)
    {
        // Filter alamat tujuan (mis: kota atau daerah tujuan)
        if (!empty($filters['alamat_tujuan'])) {
            $query->where('alamat_tujuan', 'like', '%' . $filters['alamat_tujuan'] . '%');
        }

        // Filter tahun pindah (berdasarkan tgl_pindah)
        if (!empty($filters['tahun'])) {
            $query->whereYear('tgl_pindah', $filters['tahun']);
        }

        // Filter bulan pindah
        if (!empty($filters['bulan'])) {
            $query->whereMonth('tgl_pindah', $filters['bulan']);
        }

        return $query;
    }
}
