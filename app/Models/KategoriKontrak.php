<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKontrak extends Model
{
    use HasFactory;

    protected $guarded =  ['id'];
    protected $table = 'kategorikontrak';
    protected $fillable = [
        'kategorikontrak',
    ];

 // App\Models\KategoriKontrak.php
    public function pkwt()
    {
    return $this->hasMany(Pkwt::class, 'id_kategorikontrak');
    }
}
