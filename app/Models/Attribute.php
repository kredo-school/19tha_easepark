<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory, SoftDeletes;

    function users()
    {
        return $this->hasMany(User::class);
    }

    function areas()
    {
        return $this->hasMany(Area::class);
    }
}
