<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestLogCron extends Model
{
    use HasFactory;

    protected $table = 'testlogcron';
    protected $guarded = ['id'];
    protected $fillable = [
        'datetime'
    ];
}
