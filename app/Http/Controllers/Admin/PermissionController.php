<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all permissions
        $permissions = Permission::paginate(20);

        // search box
        if ($result = request('search')) {
            $permissions = Permission::query();

            $permissions->where('name', 'LIKE', "%{$result}%")->orWhere('label', 'LIKE', "%{$result}%");

            $permissions = $permissions->paginate(20);
        }

        return view('admin.permissions.all', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validating date
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permissions'],
            'label' => ['max:255'],
        ]);

        Permission::create($data);

        Alert::success('Well done!', 'The permission created successfully');
        return redirect(route('admin.permission.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        // validating date
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('permissions')->ignore($permission->id)],
            'label' => ['max:255'],
        ]);

        $permission->update($data);

        Alert::success('Well done!', 'The permission updated successfully');
        return redirect(route('admin.permission.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        Alert::success('Well done!', 'The permission deleted successfully');
        return redirect(route('admin.permission.index'));
    }
}
