<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();

        $category = new Category();
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            // $imageExtension = $file->getClientOriginalExtension();

            $fileName = time() . '-' . $imageName;

            $file->move('uploads/category/', $fileName);

            $category->image = $fileName;
        }

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        // $category->is_active = $request->is_active == true ? 1 : 0;
        $category->status = $request->is_active == 'on' ? 1 : 0;
        $category->save();
        return redirect('admin/category')->with('message', 'Category Added Successfully');
    }


    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category)
    {

        $validatedData = $request->validated();

        $category = Category::findOrFail($category);

        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        if ($request->hasFile('image')) {
            $oldImagePath = 'uploads/category/' . $category->image;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            // $imageExtension = $file->getClientOriginalExtension();

            $fileName = time() . '-' . $imageName;

            $file->move('uploads/category/', $fileName);

            $category->image = $fileName;
        }

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        $category->is_active = $request->is_active == true ? 1 : 0;
        $category->update();
        return redirect('admin/category')->with('message', 'Category Updated Successfully');
    }


    public function destroy(Category $category)
    {

        $oldImagePath = 'uploads/category/' . $category->image;
        if (File::exists($oldImagePath)) {
            File::delete($oldImagePath);
        }

        Category::destroy($category->id);
        return redirect('admin/category')->with('message', 'Category Deleted Successfully');
    }
}
