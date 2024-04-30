<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AreasController extends Controller
{
    public function editRegisteredAreas(){
        return view('admin.areas.edit');
    }

    public function default(){
        return view('admin.areas.show');
    }

}
