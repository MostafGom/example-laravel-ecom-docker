<?php

namespace App\Livewire\Admin\VariantAttribute;

use App\Http\Requests\VariantAttributeRequest;
use App\Models\VariantAttribute;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Index extends Component
{


    use WithPagination;

    public $name = '';
    public $variant_id;
    public $allVariants = [];
    public VariantAttribute $variantToDelete;
    public VariantAttribute $variantAttribute;

    #[Url(history: true)]
    public $search = '';
    #[Url(history: true)]
    public $sortBy = 'created_at';
    #[Url(history: true)]
    public $sortDirection = 'DESC';

    public $perPage = 5;

    public function rules()
    {
        return (new VariantAttributeRequest())->rules();
    }

    public function updatedSearch()
    {

        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function mount(VariantAttribute $variantAttribute)
    {
        $this->allVariants = DB::select('select * from variants');
        $this->variantAttribute = $variantAttribute;
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
        $variantAttributes = VariantAttribute::search($this->search)
            ->with(['variant'])
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
        return view('livewire.admin.variant-attribute.index', ['variantAttributes' => $variantAttributes]);
    }

    public function resetInputs()
    {
        $this->name = '';
        $this->variant_id = '';
        $this->variantAttribute = new VariantAttribute();
        $this->variantToDelete = new VariantAttribute();
    }


    public function saveVariantAttribute()
    {
        $validatedData = $this->validate();
        $this->variant->fill($validatedData);
        $this->variantAttribute->save();

        session()->flash('message', 'Variant Saved Successfully');
        $this->dispatch('close-variant-attribute-form-modal');
        $this->resetInputs();
    }

    public function editVariantAttribute($variantId)
    {
        $this->variantAttribute = VariantAttribute::findOrFail($variantId);
        $this->name = $this->variantAttribute->name;
        $this->variant_id = $this->variantAttribute->variant->id;
    }

    public function deleteVariantAttribute($id)
    {
        $this->variantToDelete = VariantAttribute::findOrFail($id);
    }

    public function destroyVariantAttribute()
    {
        $this->variantToDelete->delete();
        session()->flash('message', 'Variant Deleted Successfully');
        $this->dispatch('close-delete-variant-attribute-modal');
        $this->resetInputs();
    }
}
