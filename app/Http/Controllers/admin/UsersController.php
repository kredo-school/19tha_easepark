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
        $query = $this->user->withTrashed();

        if ($request->search) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('phone_number', 'like', '%' . $request->search . '%');
            });
        }

        $all_users = $query->orderBy('id')->paginate(5);

        return view('admin.users.show')
            ->with('all_users', $all_users)
            ->with('search', $request->search);
    }

    public function deactivateUsers($id)
    {
        $this->user->destroy($id);
        return redirect()->back()->with('success_delete', 'Account deactivated successfully.');
    }

    public function activateUsers($id)
    {
        $this->user->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back()->with('success_restore', 'Account activated successfully.');
    }
}
