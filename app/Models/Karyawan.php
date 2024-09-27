<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'karyawan';

    protected $fillable = [
        'nik',
        'name',
        'jabatan',
        'tgl_lahir',
        'cakar',
        'formFileSm',
        'pilihan_pensiun',
        'notifikasi_pensiun_1_at',
        'notifikasi_pensiun_1_readed',
        'notifikasi_pensiun_2_at',
        'notifikasi_pensiun_2_readed',
        'notifikasi_peringatan_pada',
        'tanggal_terakhir_pensiun',
        'notifikasi_peringatan_dikirim_pada',
        'notifikasi_peringatan_pada',
        'notifikasi_peringatan_dibaca_pada',
    ];

    public function book()
    {
        return $this->hasOne(Book::class, 'id_karyawan');
    }

    public function bookActive()
    {
        return $this->hasOne(Book::class, 'id_karyawan')->where('status', 1);
    }
    
    public function historyKenaikanTingkat()
    {
        return $this->hasMany(ApprovelKenaikan::class, 'id_karyawan')->latest();
    }

    public function lastKenaikanTingkat()
    {
        return $this->hasOne(ApprovelKenaikan::class, 'id_karyawan')->latest();
    }
}
