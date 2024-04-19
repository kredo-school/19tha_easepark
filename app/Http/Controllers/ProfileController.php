<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // private $user;

    // public function __construct(User $user) {
    //     $this->user = $user;
    // }

    public function showProfile() {
        return view('users.profile.show');
    }
}
