<?php

namespace App\Livewire\Admin\ProductVariantAttribute;

use App\Http\Requests\ProductVariantAttributeRequest;
use App\Models\ProductVariantAttribute;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $name = '';
    public $price_override = '';
    public $stock_quantity = '';
    public $sku = '';
    public $product_id;
    public $variant_attribute_id;
    public $allVariantAttributes = [];
    public $allProducts = [];
    public ProductVariantAttribute $productVariantAttributeToDelete;
    public ProductVariantAttribute $productVariantAttribute;

    #[Url(history: true)]
    public $search = '';
    #[Url(history: true)]
    public $sortBy = 'created_at';
    #[Url(history: true)]
    public $sortDirection = 'DESC';

    public $perPage = 5;

    public function rules()
    {
        return (new ProductVariantAttributeRequest())->rules();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function mount(ProductVariantAttribute $productVariantAttribute)
    {
        $this->allVariantAttributes = DB::select('select * from variant_attributes');
        $this->allProducts = DB::select('select * from products');
        $this->productVariantAttribute = $productVariantAttribute;
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
        $productVariantAttributes = ProductVariantAttribute::searchWithVariantAttribute($this->search)
            ->with(['variantAttribute'])
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.product-variant-attribute.index', ['productVariantAttributes' => $productVariantAttributes]);
    }

    public function resetInputs()
    {
        $this->name = '';
        $this->variant_attribute_id = '';
        $this->product_id = '';
        $this->productVariantAttribute = new ProductVariantAttribute();
        $this->productVariantAttributeToDelete = new ProductVariantAttribute();
        $this->price_override = '';
        $this->sku = '';
        $this->stock_quantity = '';
    }

    public function saveProductVariantAttribute()
    {
        $validatedData = $this->validate();
        $this->variant->fill($validatedData);
        $this->productVariantAttribute->save();

        session()->flash('message', 'Variant Saved Successfully');
        $this->dispatch('close-variant-attribute-form-modal');
        $this->resetInputs();
    }

    public function editProductVariantAttribute($variantId)
    {
        $this->productVariantAttribute = ProductVariantAttribute::findOrFail($variantId);
        $this->name = $this->productVariantAttribute->name;
        $this->variant_attribute_id = $this->productVariantAttribute->variant_attribute_id;
        $this->product_id = $this->productVariantAttribute->product_id;
        $this->price_override = $this->productVariantAttribute->price_override;
        $this->sku = $this->productVariantAttribute->sku;
        $this->stock_quantity = $this->productVariantAttribute->stock_quantity;
    }

    public function deleteProductVariantAttribute($id)
    {
        $this->productVariantAttributeToDelete = ProductVariantAttribute::findOrFail($id);
    }

    public function destroyProductVariantAttribute()
    {
        $this->variantToDelete->delete();
        session()->flash('message', 'Variant Deleted Successfully');
        $this->dispatch('close-delete-variant-attribute-modal');
        $this->resetInputs();
    }
}
