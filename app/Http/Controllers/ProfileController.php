<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

    public function editProfile() {
        $attributes = ['General', 'EV', 'Disability'];
        return view('users.profile.edit')->with('attributes', $attributes);
    }

}
