<?php

namespace App\Livewire\Admin\Variant;

use App\Http\Requests\VariantFormRequest;
use App\Models\Variant;
use Livewire\Component;
use Livewire\Attributes\Url;

class Index extends Component
{

    public $name = '';

    #[Url(history: true)]
    public $search = '';
    #[Url(history: true)]
    public $sortBy = 'created_at';
    #[Url(history: true)]
    public $sortDirection = 'DESC';

    public $perPage = 5;

    public function rules()
    {
        return (new VariantFormRequest())->rules();
    }

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


    public function render()
    {

        $variants = Variant::search($this->search)
            // ->with(['images','categories', 'brand'])
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
        return view('livewire.admin.variant.index', ['variants' => $variants]);
    }


    public function resetInputs()
    {
        $this->name = '';
    }


    public function addVariant()
    {
        $validatedData = $this->validate();

        Variant::create([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Variant Created Successfully');
        $this->dispatch('close-add-variant-modal');
        $this->resetInputs();
    }
}
