<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    function area()
    {
        return $this->belongsTo(Area::class)->withTrashed();
    }
}
