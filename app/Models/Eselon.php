<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eselon extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'eselon';
    protected $fillable = [
        'eselon',  
        'min_gol', 
        'max_gol'  
    ];

    public function book(){
        return $this->belongsTo('eselon');
    }
    
}
