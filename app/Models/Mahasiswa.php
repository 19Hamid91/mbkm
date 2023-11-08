<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $guarded = [];
    function user()
    {
        return $this->belongsTo(User::class);
    }
    function logbook()
    {
        return $this->hasMany(Logbook::class);
    }
    function mbkm()
    {
        return $this->hasMany(Mbkm::class);
    }
    function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
