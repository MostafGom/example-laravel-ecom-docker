<?php

namespace App\Livewire\Admin\Brand;

use App\Http\Requests\BrandFormRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

class Index extends Component
{
    use WithPagination;

    public $brand_id;



    #[Url(history: true)]
    public $search = '';
    #[Url(history: true)]
    public $sortBy = 'created_at';
    #[Url(history: true)]
    public $sortDirection = 'DESC';

    public $perPage = 5;


    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function setSortBy($sortColumn)
    {
        if ($this->sortBy === $sortColumn) {
            $this->sortDirection = ($this->sortDirection === 'ASC') ? 'DESC' : 'ASC';
            return;
        }
        $this->sortBy = $sortColumn;
        $this->sortDirection = 'DESC';
    }

    protected function rules(): array
    {
        return (new BrandFormRequest())->rules();
    }

    public function resetInputs()
    {
        $this->brand_id = null;
    }


    public function addBrand()
    {
        $validatedData = $this->validate();
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'is_active' => $this->is_active == true ? 1 : 0
        ]);

        session()->flash('message', 'Brand Added Successfully');
        $this->dispatch('close-add-brand-modal');
        $this->resetInputs();
    }


    public function render()
    {
        $brands = Brand::search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
        return view('livewire.admin.brand.index', ['brands' => $brands]);
    }

    public function deleteBrand($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    public function destroyBrand()
    {
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('message', 'Brand Deleted Successfully');
        $this->dispatch('close-delete-brand-modal');
        $this->resetInputs();
    }
}
