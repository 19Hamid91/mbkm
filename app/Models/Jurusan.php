<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    function prodi(){
        return $this->hasMany(Prodi::class,'id', 'jurusan_id');
    }
}
