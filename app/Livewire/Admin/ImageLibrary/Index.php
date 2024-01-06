<?php

namespace App\Livewire\Admin\ImageLibrary;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads;
    use WithPagination;

    // #[Validate(['images.*' => 'image|max:1024'])]
    public $images = [];
    public $imageToDelete = '';
    public $iteration = 0;


    #[Url(history: true)]
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    function rules()
    {
        return ['images.*' => 'image|max:1024'];
    }

    public function render()
    {
        $imagesInLibrary = Image::search($this->search)->orderBy('id', 'desc')->paginate(15);
        return view('livewire.admin.image-library.index', ['imagesInLibrary' => $imagesInLibrary]);
    }

    public function addImage()
    {
        $validatedData = $this->validate();
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
            $this->resetInputs();
        }
    }


    public function resetInputs()
    {
        $this->images = [];
        $this->imageToDelete = '';
        $this->iteration++;
    }

    public function deleteImage($imagPath)
    {
        $this->imageToDelete = $imagPath;
    }

    public function destroyImage()
    {
        $imageToFind = Image::findOrFail($this->imageToDelete);
        $imagePathToDelete = $imageToFind['image_path'];
        $imageToFind->delete();
        Storage::disk('public')->delete($imagePathToDelete);

        session()->flash('message', 'Image Deleted Successfully');
        $this->dispatch('close-delete-image-modal');
        $this->resetInputs();
    }
}
