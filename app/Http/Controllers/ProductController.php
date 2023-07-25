<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Integration\Database\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(20);
        return view('product.index', compact('products'));
    }

    public function single(Product $product)
    {
        return view('product.single', compact('product'));
    }
}
