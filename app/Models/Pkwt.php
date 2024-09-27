<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pkwt extends Model
{
    use HasFactory;

    protected $table = 'pkwt';
    protected $guarded = ['id'];
    protected $fillable = [
        'nik',
        'formFileSm',
        'full_name',
        'jabatan',
        'tgl_bergabung',
        'tgl_berakhir',
        'notifikasi_pkwt_at',
        'notifikasi_pkwt_readed',
        'id_kategorikontrak'
    ];

    // App\Models\Pkwt.php
    public function kategoriKontrak()
    {
    return $this->belongsTo(KategoriKontrak::class, 'id_kategorikontrak');
    }

}
