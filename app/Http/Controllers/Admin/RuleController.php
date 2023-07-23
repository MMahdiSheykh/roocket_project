<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all rules
        $rules = Rule::paginate(20);

        // search box
        if ($result = request('search')) {
            $rules = Rule::query();

            $rules->where('name', 'LIKE', "%{$result}%")->orWhere('label', 'LIKE', "%{$result}%");

            $rules = $rules->paginate(20);
        }

        return view('admin.rules.all', compact('rules'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validating data
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:rules'],
            'label' => ['max:255'],
            'permissions' => ['required', 'array'],
        ]);

        $role = Rule::create($data);
        $role->permissions()->sync($data['permissions']);

        Alert::success('Well done!', 'The rule created successfully');
        return redirect(route('admin.rule.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rule $rule)
    {
        return view('admin.rules.edit', compact('rule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rule $rule)
    {
        // validating date
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', \Illuminate\Validation\Rule::unique('rules')->ignore($rule->id)],
            'label' => ['max:255'],
            'permissions' => ['required', 'array'],
        ]);

        $rule->update($data);
        $rule->permissions()->sync($data['permissions']);

        Alert::success('Well done!', 'The position updated successfully');
        return redirect(route('admin.rule.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rule $rule)
    {
        $rule->delete();
        Alert::success('Well done!', 'The rule deleted successfully');
        return redirect(route('admin.rule.index'));
    }
}
