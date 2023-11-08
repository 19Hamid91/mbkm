<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KknMember extends Model
{
    use HasFactory;
    protected $guarded = [];
    function kkn()
    {
        return $this->belongsTo(Kkn::class);
    }
}
