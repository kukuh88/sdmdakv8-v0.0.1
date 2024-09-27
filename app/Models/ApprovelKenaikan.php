<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovelKenaikan extends Model
{
    use HasFactory;

    protected $table = 'approvel_kenaikan';
    protected $guarded = ['id'];
    protected $fillable = [
        'id_karyawan',
        'golonganini',
        'golongannaik',
        'status',
        'keterangan',
        'approved_at',
        'approved_by',
    ];
}
