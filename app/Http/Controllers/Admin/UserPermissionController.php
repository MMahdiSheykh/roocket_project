<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rule;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserPermissionController extends Controller
{
    public function create(User $user)
    {
        return view('admin.users.permissions', compact('user'));
    }

    public function store(Request $request, User $user)
    {
        // validating data
        $data = $request->validate([
            'permissions' => ['required', 'array'],
            'rules' => ['required', 'array'],
        ]);

        //sync data in database
        $user->permissions()->sync($data['permissions']);
        $user->rules()->sync($data['rules']);

        Alert::success('Well done!', 'Permissions and rules applied successfully');
        return redirect(route('admin.users.index'));
    }
}
