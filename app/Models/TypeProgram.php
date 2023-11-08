<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProgram extends Model
{
    use HasFactory;
    protected $guarded = [];
    function mbkm()
    {
        return $this->hasMany(Mbkm::class);
    }
    function pic()
    {
        return $this->hasOne(Pic::class);
    }
}
