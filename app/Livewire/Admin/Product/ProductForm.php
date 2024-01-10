<?php

namespace App\Livewire\Admin\Product;

use App\Http\Requests\ProductFormRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

class ProductForm extends Component
{
    use WithPagination;
    use WithFileUploads;

    public Product $product;
    public $productCategoriesIds = [];
    public $productBrandId;

    public $allCategories = [];
    public $allBrands = [];
    public $productImagesIds = [];
    public $productImages = [];


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

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->productCategoriesIds = $this->product->categories()->pluck('category_id')->toArray();
        $this->productImages = $this->product->images()->get()->toArray();

        $this->allCategories = DB::select('select * from categories');
        $this->allBrands = DB::select('select * from brands');
    }

    public function render()
    {
        $imagesInLibrary = Image::orderBy('id', 'desc')->cursorPaginate(15);

        return view('livewire.admin.product.product-form', ['imagesInLibrary' => $imagesInLibrary]);
    }

    public function rules()
    {
        return (new ProductFormRequest())->rules();
    }


    public function resetInputs()
    {
        $this->images = [];
        $this->imageToDelete = '';
        $this->iteration++;
    }


    public function addProduct()
    {
        foreach ($this->productImages as $value) {
            array_push($this->productImagesIds, $value['id']);
        }
        dd($this->productImages);
        $this->validate();
        $this->product->save();
        $this->product->images()->sync($this->productImagesIds);
        $this->product->categories()->sync($this->productCategoriesIds);

        return redirect('admin/product')->with('message', 'Product From LiveWire Added Successfully');
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
