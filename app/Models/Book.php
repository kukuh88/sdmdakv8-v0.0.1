<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'book';
    protected $fillable = [
        'id_karyawan',
        // 'name',
        // 'jabatan',
        'golonganini',
        'tmt_golonganini',
        'golongan',
        'tmt_golongan',
        'eselon',
        'tmt_eselon',
        'status',
        'is_pilihan',
        'hold',
        'last_approval_id',
    ];

    // protected $dates = ['tmt_golonganini', 'tmt_eselon'];
    public function eselon()
    {
        return $this->hasMany('book');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
    
    public function historyKenaikanTingkat()
    {
        return $this->hasOne(ApprovelKenaikan::class, 'id_karyawan', 'id_karyawan')->latest();
    }

    public function lastKenaikanTingkat()
    {
        return $this->hasOne(ApprovelKenaikan::class, 'id_karyawan', 'id_karyawan')->latest();
    }
}
