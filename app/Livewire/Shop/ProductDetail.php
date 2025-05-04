<?php

namespace App\Livewire\Shop;

use Livewire\Component;

class ProductDetail extends Component
{
    public $product;
    public $price;
    public $salePrice;
    public $selectedAttributes = [];
    public $productAttributes;

    public function mount($product)
    {
        \Log::info('Mount method triggered');
        $this->product = $product;
        $this->price = $product->price;
        $this->salePrice = $product->sale_price;
    }

    public function updated($propertyName)
    {
        if (str_starts_with($propertyName, 'selectedAttributes')) {
            $query = $this->product->variants();
            foreach ($this->selectedAttributes as $key => $value) {
                $query->where("attributes->$key", $value);
            }
            $variant = $query->first();
            $this->price = $variant ? $variant->price : $this->product->price;
            $this->salePrice = $variant ? $variant->sale_price : $this->product->sale_price;
        }
    }

    public function render()
    {
        return view('livewire.shop.product-detail');
    }
}
