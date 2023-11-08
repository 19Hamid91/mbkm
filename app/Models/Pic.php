<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    use HasFactory;
    
    function user()
    {
        return $this->belongsTo(User::class);
    }
    function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
    function typeProgram()
    {
        return $this->belongsTo(TypeProgram::class);
    }
}
