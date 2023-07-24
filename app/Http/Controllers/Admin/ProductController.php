<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all products
        $products = Product::paginate(20);

        // search box
        if ($result = request('search')) {
            $products = Product::query();

            $products->where('name', 'LIKE', "%{$result}%")
                ->orWhere('description', 'LIKE', "%{$result}%");

            $products = $products->paginate(20);
        }

        return view('admin.product.all', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

//        dd($request);
        // validating date
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:1000'],
            'price' => ['required', 'integer'],
            'inventory' => ''
        ]);


        // temp value for inventory field
//        $data = ['inventory' => 0];

        Product::create($data);

        Alert::success('Well done!', 'Your product has been created successfully');
        return redirect(route('admin.product.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
