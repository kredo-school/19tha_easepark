<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, SoftDeletes;

    function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    function attribute()
    {
        return $this->belongsTo(Attribute::class)->withTrashed();
    }

    function fee()
    {
        return $this->belongsTo(Fee::class)->withTrashed();
    }
}
