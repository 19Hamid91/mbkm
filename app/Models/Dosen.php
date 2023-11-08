<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    public function mbkm()
    {
        return $this->hasOne(Mbkm::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'nip', 'email');
    }
        function pic()
    {
        return $this->hasOne(Pic::class);
    }
}
