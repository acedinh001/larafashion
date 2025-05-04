<?php

namespace App\Livewire\Shop;

use App\Livewire\Traits\WithCartFunctions;
use Livewire\Component;
use MongoDB\Driver\Session;

class ProductDetail extends Component
{
    use WithCartFunctions;

    public $product;
    public $price;
    public $salePrice;
    public $quantity = 1;
    public $selectedAttributes = [];
    public $productAttributes;

    public function mount($product)
    {
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

    public function increaseQuantity()
    {
        $this->quantity++;
    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCartFromDetail()
    {
        $this->addToCart($this->product, $this->quantity, $this->selectedAttributes, $this->price, $this->salePrice);
    }

    public function render()
    {
        return view('livewire.shop.product-detail');
    }
}
