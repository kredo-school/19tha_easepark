<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attribute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function showProfile($id)
    {
        $user =  $this->user->findOrFail($id);
        return view('users.profile.show')
            ->with('user', $user);
    }

    public function editProfile()
    {
        $user = $this->user->findOrFail(Auth::user()->id);
        $all_attributes = Attribute::all();

        return view('users.profile.edit')
            ->with('user', $user)
            ->with('all_attributes', $all_attributes);
    }


    public function updateProfile(Request $request)
    {

        $request->validate([
            'name' => 'required|min:1|max:50',
            'email' => 'required|email|max:50|unique:users,email,' . Auth::user()->id,
            'phone_number' => 'required|min:1|max:50',
            'plate_number' => 'required|min:1|max:50',
            'attribute' => 'required|exists:attributes,id'
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->plate_number = $request->plate_number;
        $user->attribute_id = $request->attribute;

        $user->save();

        return redirect()->route('profile.show', $user->id);
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            return redirect()->route('profile.edit')->withInput()->withErrors(['old_password' => 'The current password is incorrect.']);
        }

        if ($request->get('old_password') === $request->get('new_password')) {
            return redirect()->route('profile.edit')->withInput()->withErrors(['new_password' => 'The new password cannot be the same as the current password.']);
        }

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed'
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->get('new_password'));
        $user->save();

        return redirect()->route('profile.show', $user->id);
    }

    public function deactivate(Request $request, User $user)
    {
        $user = $this->user->findOrFail(Auth::user()->id);
        $user->delete();
        return redirect()->route('homepage');
    }
}
