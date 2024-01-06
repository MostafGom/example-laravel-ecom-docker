<?php

namespace App\Livewire\Admin\Product;

use App\Http\Requests\ProductFormRequest;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\Debugbar\Facades\Debugbar as Debugbar;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class Index extends Component
{

    use WithPagination;

    // attributesto be used in edit product
    public $edit_product_id = 0;
    public $foundProduct = null;
    public $productImagesEdit = [];


    #[Url(history: true)]
    public $search = '';
    #[Url(history: true)]
    public $sortBy = 'created_at';
    #[Url(history: true)]
    public $sortDirection = 'DESC';

    public $perPage = 5;

    public function rules()
    {
        return (new ProductFormRequest())->rules();
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
        $products = Product::search($this->search)
            // ->with(['images','categories', 'brand'])
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
        return view('livewire.admin.product.index', ['products' => $products]);
    }

    public function deleteProduct()
    {
    }

    public function destroyProduct()
    {
    }
}
