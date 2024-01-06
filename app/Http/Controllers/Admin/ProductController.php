<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function create()
    {
        $brands = DB::select('select * from brands');

        $imagesInLibrary = Image::orderBy('id', 'desc')->cursorPaginate(5);
        $categories = DB::select('select * from categories');

        return view('admin.product.create', ['brands' => $brands, 'imagesInLibrary' => $imagesInLibrary, 'categories' => $categories]);
    }
    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }
}
