<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hoteldetail extends Model
{
    use HasFactory;

    public function users()
    {
      return $this->belongsToMany(\App\Models\User::class)->withPivot('created_at');
    }
}
