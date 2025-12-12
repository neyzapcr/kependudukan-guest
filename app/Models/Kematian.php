<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Kematian extends Model
{
    protected $primaryKey = 'kematian_id';
    protected $table = 'peristiwa_kematian';
    protected $fillable = [
        'warga_id', 'tgl_meninggal', 'sebab', 'lokasi', 'no_surat'
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }
    public function scopeSearch($query, $keyword)
    {
        if (!$keyword) return $query;

        return $query->whereHas('warga', function ($q) use ($keyword) {
            $q->where('nama', 'like', "%$keyword%");
        })
        ->orWhere('lokasi', 'like', "%$keyword%")
        ->orWhere('sebab', 'like', "%$keyword%")
        ->orWhere('no_surat', 'like', "%$keyword%");
    }

    /**
     * FILTER (lokasi, tahun, bulan)
     */
    public function scopeFilter($query, $filters)
    {
        // Filter lokasi
        if (!empty($filters['lokasi'])) {
            $query->where('lokasi', 'like', "%" . $filters['lokasi'] . "%");
        }

        // Filter tahun meninggal
        if (!empty($filters['tahun'])) {
            $query->whereYear('tgl_meninggal', $filters['tahun']);
        }

        // Filter bulan meninggal
        if (!empty($filters['bulan'])) {
            $query->whereMonth('tgl_meninggal', $filters['bulan']);
        }

        return $query;
    }

}
