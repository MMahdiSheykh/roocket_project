<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);

        // search box
        if ($result = request('search')) {
            $categories = Category::query();

            $categories->where('name', 'LIKE', "%{$result}%");
            // todo اضافه کردن سرچ توی name های parent_id ها
//                ->orWhereHas('child', function ($query) use ($result) {
//                    $query->where('name', 'LIKE', "%{$result}%");
//                });

            $categories = $categories->paginate(20);
        }

        // parent category and child category buttons
        if (request('parent')) {
            $categories = Category::query();

            if (request('parent') == 'parent') {
                $categories->where('parent_id', '=', 0);
            } elseif (request('parent') == 'child') {
                $categories->where('parent_id', '!=', 0);
            }
            $categories = $categories->paginate(20);
        }

        return view('admin.categories.all', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validating the parent_id column, if exist
        if ($request->parent_id) {
            $request->validate([
                'parent_id' => 'exists:categories,id'
            ]);
        }

        Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id ?? 0
        ]);

        Alert::success('Well done!', 'The category created successfully');
        return redirect(route('admin.categories.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // validating date
        $validData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
//            'parent_id' => ['required'],
        ]);

        $category->update($validData);

        Alert::success('Well done!', 'The category updated successfully');
        return redirect(route('admin.categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        Alert::success('Well done!', 'Your category had been deleted successfully');
        return back();
    }
}
