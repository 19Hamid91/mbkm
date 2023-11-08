<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatkulSwap extends Model
{
    use HasFactory;
    protected $guarded = [];
    function swapStudent()
    {
        return $this->belongsTo(SwapStudent::class);
    }
}
