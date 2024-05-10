<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;

class AdminsController extends Controller
{
    private $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function registerAdmin() {
        return view('admin.admins.register');
    }
    public function editAdmin() {
        return view('admin.admins.edit');
    }
    public function showAdmins(Request $request) {
        if($request->search) {
            $admins = $this->admin
            ->where('name', 'like', '%' . $request->search . '%')
            ->paginate(5);
        } else {
            $admins = $this->admin->paginate(5);
        }

        return view('admin.admins.show',['admins'=>$admins])->with('search', $request->search);
    }
}