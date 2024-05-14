<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function showUsers(Request $request)
    {
        if ($request->search) {
            $all_users = $this->user->withTrashed()
                ->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('phone_number', 'like', '%' . $request->search . '%')
                ->paginate(5);
        } else {
            $all_users = $this->user->orderBy('name')->withTrashed()
                ->paginate(5);
        }

        return view('admin.users.show')
            ->with('all_users', $all_users)
            ->with('search', $request->search);
    }

    public function deactivateUsers($id)
    {
        $this->user->destroy($id);
        return redirect()->back();
    }

    public function activateUsers($id)
    {
        $this->user->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
}
