<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function registerAdmin() {
        return view('admin.admins.register');
    }
    public function editAdmin() {
        return view('admin.admins.edit');
    }
    public function showAdmins() {
        return view('admin.admins.show');
    }
}