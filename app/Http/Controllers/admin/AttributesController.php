<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttributesController extends Controller
{
    public function showAttribute()
    {
        return view('admin.attributes.show');
    }


    public function editAttribute()
    {
        return view('admin.attributes.edit');
    }
    public function default()
    {
        return view('admin.attributes.show');
    }
}
