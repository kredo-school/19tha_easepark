<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;

class AdminsController extends Controller
{
    private $admin;

    public function __construct(Admin $admin) {
        $this->admin = $admin;
    }
    public function showAdmins(Request $request) {
        if($request->search) {
            $admins = $this->admin
            ->where('name', 'like', '%' . $request->search . '%')
            ->orderBy('id', 'asc')
            ->paginate(5);
        } else {
            $admins = $this->admin->paginate(5);
        }

        return view('admin.admins.show',['admins'=>$admins])->with('search', $request->search);
    }
    public function registerAdmin() {
        return view('admin.admins.register');
    }
    public function editAdmin($id) {
        $admin = Admin::findOrFail($id);

        if (auth('admin')->user()->id != $admin->id) {
            return redirect()->route('admin.admins.show');
        }
        
        return view('admin.admins.edit', ['admin' => $admin]);
    }

    public function updateAdmin(Request $request) {

        $request->validate([
            'name' => 'required|min:1|max:50',
            'email' => 'required|email|max:50|unique:admins,email,' . auth('admin')->user()->id,
        ]);

        $admin = $this->admin->findOrFail(auth('admin')->user()->id);
        $admin->name = $request->name;
        $admin->email = $request->email;
    
        $admin->save();

        return redirect()->route('admin.admins.show', $admin->id)->with('success', 'Profile updated successfully.');
    }

    public function changePassword(Request $request) {
        // confirm current password
        if (!(Hash::check($request->get('current_password'), auth('admin')->user()->password))) {

            return redirect()->route('admin.admins.edit')->withInput()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // check if current password = new password or not 
        if ($request->get('current_password') === $request->get('new_password')) {
            return redirect()->route('admin.admins.edit')->withInput()->withErrors(['new_password' => 'The new password cannot be the same as the current password.']);
        }

        // validate new password and confirm
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed'
        ]);

        $admin = $this->admin->findOrFail(auth('admin')->user()->id);
        $admin->password = Hash::make($request->get('new_password'));
        $admin->save();

        return redirect()->route('admin.admins.show', $admin->id)->with('success', 'Your password has been changed successfully.');
    }

    public function deleteAdmin() {
        $admin = $this->admin->findOrFail(auth('admin')->user()->id);
        $admin->delete();
        
        return redirect()->route('admin.admins.show', $admin->id)->with('success', 'Your admin account has been deleted successfully.');
    }
}