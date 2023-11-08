<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kkn extends Model
{
    use HasFactory;
    protected $guarded = [];

    function kknMember()
    {
        return $this->hasMany(KknMember::class);
    }
}
