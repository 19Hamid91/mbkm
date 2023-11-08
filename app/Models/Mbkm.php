<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mbkm extends Model
{
    use HasFactory;
    protected $guarded = [];
    function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
    function typeProgram()
    {
        return $this->belongsTo(TypeProgram::class);
    }
    function logbook()
    {
        return $this->hasMany(Logbook::class);
    }
    function support()
    {
        return $this->hasOne(Support::class);
    }
    function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
    function pemEx()
    {
        return $this->belongsTo(Dosbingex::class, 'dosbingex_id', 'id');
    }
    function studentSwap()
    {
        return $this->belongsTo(SwapStudent::class, 'swap_student_id', 'id');
    }
    function kkn()
    {
        return $this->belongsTo(Kkn::class);
    }
    function dosbingex()
    {
        return $this->belongsTo(Dosbingex::class);
    }
    function notif()
    {
        return $this->hasMany(Notif::class);
    }
    function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
