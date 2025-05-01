<?php

namespace App\Livewire\Shop;

use App\Models\Category;
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
    public $priceMin;
    public $priceMax;
    public $minPrice;
    public $maxPrice;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'latest'],
        'perPage' => ['except' => 12],
        'view' => ['except' => 'grid'],
        'category' => ['except' => ''],
        'priceMin' => ['except' => ''],
        'priceMax' => ['except' => '']
    ];

    public function mount()
    {
        $minRegularPrice = Product::whereNull('sale_price')->min('price') ?? 0;
        $minSalePrice = Product::whereNotNull('sale_price')->min('sale_price') ?? $minRegularPrice;
        $this->minPrice = floor(min($minRegularPrice, $minSalePrice));

        $maxRegularPrice = Product::whereNull('sale_price')->max('price') ?? 1000;
        $maxSalePrice = Product::whereNotNull('sale_price')->max('sale_price') ?? $maxRegularPrice;
        $this->maxPrice = ceil(max($maxRegularPrice, $maxSalePrice));

        $this->priceMin = $this->minPrice;
        $this->priceMax = $this->maxPrice;
    }

    public function applyPriceFilter()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'sortBy', 'category', 'priceMin', 'priceMax']);
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->category, fn($q) => $q->where('category_id', $this->category))
            ->when($this->priceMin, fn($q) => $q->where('price', '>=', $this->priceMin))
            ->when($this->priceMax, fn($q) => $q->where('price', '<=', $this->priceMax));

        $query = match($this->sortBy) {
            'latest' => $query->latest(),
            'price_asc' => $query->orderBy('price'),
            'price_desc' => $query->orderBy('price', 'desc'),
            default => $query->latest()
        };

        return view('livewire.shop.product-list', [
            'products' => $query->paginate($this->perPage),
            'categories' => Category::withCount('products')->get()
        ]);
    }

    public function toggleView($view)
    {
        $this->view = $view;
    }
}
