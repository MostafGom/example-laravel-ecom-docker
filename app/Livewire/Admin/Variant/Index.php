<?php

namespace App\Livewire\Admin\Variant;

use App\Http\Requests\VariantFormRequest;
use App\Models\Variant;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $name = '';
    public Variant $variantToDelete;
    public Variant $variant;

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

    public function mount(Variant $variant)
    {
        $this->variant = $variant;
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
            'name' => $validatedData['name'],
        ]);
        session()->flash('message', 'Variant Created Successfully');
        $this->dispatch('close-add-variant-modal');
        $this->resetInputs();
    }

    public function editVariant($variantId)
    {
        $this->variant = Variant::findOrFail($variantId);
        $this->name = $this->variant->name;
    }

    public function updateVariant()
    {
        $validatedData = $this->validate();
        $this->variant->name = $validatedData['name'];
        $this->variant->save();

        session()->flash('message', 'Variant Updated Successfully');
        $this->dispatch('close-edit-variant-modal');
        $this->resetInputs();
    }


    public function deleteVariant($id)
    {
        $this->variantToDelete = Variant::findOrFail($id);
    }

    public function destroyVariant()
    {
        $this->variantToDelete->delete();
        session()->flash('message', 'Variant Deleted Successfully');
        $this->dispatch('close-delete-variant-modal');
        $this->resetInputs();
    }
}
