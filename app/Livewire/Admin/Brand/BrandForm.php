<?php

namespace App\Livewire\Admin\Brand;

use App\Http\Requests\BrandFormRequest;
use App\Models\Brand;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class BrandForm extends Component
{
    use WithPagination;
    use WithFileUploads;

    public Brand $brand;


    public $brandImage;

    #[Validate(['images.*' => 'image|max:1024'])]
    public $images = [];

    public $imageToDelete = '';
    public $iteration = 0;

    public function resetImageInputs()
    {
        $this->images = [];
        $this->imageToDelete = '';
        $this->iteration++;
    }

    public function mount(Brand $brand)
    {
        $this->brand = $brand;
        if ($this->brand->exists) {
            $this->brandImage = $this->brand->image()->get()[0];
        }

        $this->brand->is_active = $this->brand->is_active ?? 0;
    }

    public function render()
    {
        $imagesInLibrary = Image::orderBy('id', 'desc')->cursorPaginate(15);

        return view('livewire.admin.brand.brand-form', ['imagesInLibrary' => $imagesInLibrary]);
    }

    public function rules()
    {
        return (new BrandFormRequest())->rules();
    }

    public function addBrand()
    {
        $this->validate();
        $this->brand->is_active = $this->brand->is_active ? 1 : 0;
        $this->brand->save();

        return redirect('admin/brand')->with('message', 'Brand From LiveWire Added Successfully');
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
            $this->resetImageInputs();
        }
    }
}
