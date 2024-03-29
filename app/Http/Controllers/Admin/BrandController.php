<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function index()
    {
        return view('admin.brand.index');
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }
}
