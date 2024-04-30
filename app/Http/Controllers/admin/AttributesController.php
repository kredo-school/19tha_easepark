<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttributesController extends Controller
{
    public function editAttribute()
    {
        return view('admin.attributes.edit');
    }
    public function default()
    {
        return view('admin.attributes.show');
    }
}
