<?php

namespace App\Livewire\Traits;

trait WithCartFunctions
{
    public function addToCart($product, $quantity = 1, $attributes = [], $price = null, $salePrice = null)
    {
        if ($quantity < 1) {
            $this->dispatch('notify', ['message' => 'Quantity must be at least 1']);
            return;
        }
        $cartItem = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $price ?? $product->price,
            'sale_price' => $salePrice ?? $product->sale_price,
            'quantity' => $quantity,
            'image' => $product->getImageUrlAttribute(),
            'slug' => $product->slug,
            'attributes' => $attributes
        ];

        $cart = session()->get('cart', []);
        $itemKey = $product->id . '_' . md5(json_encode($attributes));

        if (isset($cart[$itemKey])) {
            $cart[$itemKey]['quantity'] += $quantity;
        } else {
            $cart[$itemKey] = $cartItem;
        }

        session()->put('cart', $cart);
        $this->dispatch('cartUpdated');
        $this->dispatch('notify', ['message' => 'Product added to cart successfully!']);
    }
}
