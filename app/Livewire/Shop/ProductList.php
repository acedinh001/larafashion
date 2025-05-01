<?php

namespace App\Livewire\Shop;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'latest';
    public $perPage = 12;
    public $view = 'grid';
    public $category = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'latest'],
        'perPage' => ['except' => 12],
        'viewMode' => ['except' => 'grid'],
        'category' => ['except' => ''],
        'priceMin' => ['except' => ''],
        'priceMax' => ['except' => '']
    ];

    public function mount()
    {
        $this->priceMin = Product::min('price') ?? 0;
        $this->priceMax = Product::max('price') ?? 1000;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::query()
            ->when($this->search, function($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->category, function($query) {
                $query->where('category_id', $this->category);
            })
            ->when($this->sortBy, function($query) {
                switch($this->sortBy) {
                    case 'latest':
                        $query->latest();
                        break;
                    case 'popularity':
                        $query->orderBy('views', 'desc');
                        break;
                    case 'price_asc':
                        $query->orderBy('price', 'asc');
                        break;
                    case 'price_desc':
                        $query->orderBy('price', 'desc');
                        break;
                }
            })
            ->paginate($this->perPage);

        return view('livewire.shop.product-list', [
            'products' => $products
        ]);
    }

    public function toggleView($view)
    {
        $this->view = $view;
    }
}
