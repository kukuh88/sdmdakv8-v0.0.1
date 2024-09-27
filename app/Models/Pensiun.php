<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pensiun extends Model
{
    use HasFactory;
    protected $table = 'pensiun';
    protected $guarded = ['id'];

    protected $fillable = [
        'id_karyawan',
        'is_pensiun',
    ];
}
