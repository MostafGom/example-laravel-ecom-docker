<?php

namespace App\Livewire\Admin\Category;

use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CategoryForm extends Component
{

    use WithPagination;
    use WithFileUploads;

    public Category $category;

    public $categoryImage = [];


    #[Validate(['images.*' => 'image|max:1024'])]
    public $images = [];

    public $imageToDelete = '';
    public $iteration = 0;


    public function resetInputs()
    {
        $this->images = [];
        $this->imageToDelete = '';
        $this->iteration++;
    }
    public function mount(Category $category)
    {
        $this->category = $category;
        $this->categoryImage = $this->category->image()->get();
        $this->category->is_active =  $this->category->is_active ?? 0;
    }

    public function render()
    {
        $imagesInLibrary = Image::orderBy('id', 'desc')->cursorPaginate(15);

        return view('livewire.admin.category.category-form', ['imagesInLibrary' => $imagesInLibrary]);
    }

    public function rules()
    {
        return (new CategoryFormRequest())->rules();
    }

    public function addCategory()
    {
        // $this->validate();
        // dd($this->category);
        $this->category->is_active = $this->category->is_active ? 1 : 0;

        $this->category->save();

        return redirect('admin/category')->with('message', 'Category From LiveWire Added Successfully');
    }



    public function addImage()
    {
        foreach ($this->images as $imagefile) {

            $originalName = $imagefile->getClientOriginalName();
            $imageMimeType = $imagefile->getMimeType();

            $storagePath = $imagefile->store('uploads/image-library', 'public');
            Image::create([
                'image_path' => Storage::url($storagePath),
                'original_name' => $originalName,
                'mime_type' => $imageMimeType,
            ]);

            session()->flash('message', 'Images Uploaded Successfully');
            $this->dispatch('close-add-image-modal');
            // $this->resetInputs();
        }
    }
}
