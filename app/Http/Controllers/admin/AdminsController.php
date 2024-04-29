<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function showAdmins() {
        return view('admin.admins.show');
    }
    
    public function registerAdmin() {
        return view('admin.admins.register');
    }
}