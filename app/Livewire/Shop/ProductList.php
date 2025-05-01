<?php

namespace App\Livewire\Shop;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'latest';
    public $perPage = 12;
    public $view = 'grid';
    public $priceMin;
    public $priceMax;
    public $minPrice;
    public $maxPrice;

    public $selectedCategory = null;
    public $openCategories = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'latest'],
        'perPage' => ['except' => 12],
        'view' => ['except' => 'grid'],
        'selectedCategory' => ['except' => null], // Add this line
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
        $this->reset(['search', 'sortBy', 'selectedCategory', 'priceMin', 'priceMax']);
        $this->resetPage();
    }

    public function toggleCategory($categoryId)
    {
        if (isset($this->openCategories[$categoryId])) {
            $this->openCategories = [];
            return;
        }

        // Clear all open categories and set the new one
        $this->openCategories = [$categoryId => true];
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->resetPage();
    }

    public function getCategoriesProperty()
    {
        $categories = Category::with(['children' => function ($query) {
            $query->withCount('products');
        }])
            ->withCount(['products', 'children'])
            ->has('children')
            ->orderBy('name')
            ->get();

        // Sum child products count into each parent
        $categories->each(function ($category) {
            $category->children_products_count = $category->children->sum('products_count');
        });

        return $categories;
    }

    public function render()
    {
        $query = Product::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->selectedCategory, function($q) {
                $category = Category::find($this->selectedCategory);
                if ($category) {
                    $categoryIds = collect([$category->id]);
                    if (!$category->parent_id) {
                        $categoryIds = $categoryIds->merge($category->children()->pluck('id'));
                    }
                    $q->whereIn('category_id', $categoryIds);
                }
            })
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
            'categories' => $this->categories
        ]);
    }

}
