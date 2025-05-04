<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $featuredProducts = Product::where('is_active', true)
            ->where('featured', true)
            ->take(6)
            ->get();

        return view('frontend.shop.index', [
            'products' => $products,
            'featuredProducts' => $featuredProducts
        ]);
    }

    public function show(Product $product) {
        $product->load(['variants', 'gallery']);

        $attributes = $product->variants->pluck('attributes');

        $groupedAttributes = $attributes->reduce(function ($carry, $item) {
            foreach ($item as $key => $value) {
                $carry[$key][] = $value;
            }
            return $carry;
        }, []);

        $groupedAttributes = collect($groupedAttributes)->map(function ($values) {
            return collect($values)->unique()->values()->all();
        });

        return view('frontend.shop.show', [
            'product' => $product,
            'attributes' => $groupedAttributes,
        ]);
    }
}
