<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwapStudent extends Model
{
    use HasFactory;
    protected $guarded = [];
    function typeSwap()
    {
        return $this->belongsTo(TypeSwap::class);
    }
    function matkulSwap()
    {
        return $this->hasMany(MatkulSwap::class);
    }
}
