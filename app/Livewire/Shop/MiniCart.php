<?php

namespace App\Livewire\Shop;

use Livewire\Component;


class MiniCart extends Component
{
    public $cart = [];
    public $itemCount = 0;
    public $total = 0;

    protected $listeners = ['cartUpdated' => 'updateCart'];

    public function mount()
    {
        $this->updateCart();
    }

    public function updateCart()
    {
        $this->cart = session()->get('cart', []);
        $this->itemCount = count($this->cart);
        $this->total = $this->calculateTotal();
    }

    public function updateQuantity($itemKey, $type)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$itemKey])) {
            if ($type === 'increase') {
                $cart[$itemKey]['quantity']++;
            } else {
                if ($cart[$itemKey]['quantity'] > 1) {
                    $cart[$itemKey]['quantity']--;
                }
            }
            session()->put('cart', $cart);
            $this->updateCart();
        }
    }

    public function removeItem($itemKey)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$itemKey])) {
            unset($cart[$itemKey]);
            session()->put('cart', $cart);
            $this->updateCart();
        }
    }

    private function calculateTotal()
    {
        return collect($this->cart)->sum(function ($item) {
            return ($item['sale_price'] ?? $item['price']) * $item['quantity'];
        });
    }

    public function render()
    {
        return view('livewire.shop.mini-cart');
    }
}
