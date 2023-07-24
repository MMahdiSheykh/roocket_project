<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-user')->only(['index']);
        $this->middleware('can:create-user')->only(['create', 'store']);
        $this->middleware('can:edit-user')->only(['edit', 'update']);
        $this->middleware('can:delete-user')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all users
        $users = User::paginate(20);

        // search box
        if ($result = request('search')) {
            $users = User::query();

            $users->where('email', 'LIKE', "%{$result}%")
                ->orWhere('name', 'LIKE', "%{$result}%")
                ->orWhere('id', $result);

            $users = $users->paginate(20);
        }

        // show admins or staffs
        if (request('admin') || request('staff')) {
            $users = User::query();

            if (request('admin')) {
                $users->where('is_admin', '=', 1);
                $users = $users->paginate(20);
            } else {
                $users->where('is_staff', 1);
                $users = $users->paginate(20);
            }
        }

        return view('admin.users.all', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validating date
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create($data);

        if ($request->has('verify')) {
            $user->markEmailAsVerified();
        }

        Alert::success('Well done!', 'The user created successfully');
        return redirect(route('admin.users.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // policy
        $this->authorize('edit', $user);

        return view('admin.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // validating date
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        // if admin entered password, validating password here
        if (!is_null($request->password)) {
            $data['password'] = $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }

        $user->update($data);

        if ($request->has('verify')) {
            $user->markEmailAsVerified();
        }

        Alert::success('Well done!', 'The user updated successfully');
        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        Alert::success('Well done!', 'The user deleted successfully');
        return redirect(route('admin.users.index'));
    }
}
