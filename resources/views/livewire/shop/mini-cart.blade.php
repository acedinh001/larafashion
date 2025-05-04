<div wire:ignore.self class="offCanvas__minicart">
    <div class="minicart__header ">
        <div class="minicart__header--top d-flex justify-content-between align-items-center">
            <h2 class="minicart__title h3"> Shopping Cart</h2>
            <button class="minicart__close--btn" aria-label="minicart close button" data-offcanvas="">
                <svg class="minicart__close--icon" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 512 512"><path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M368 368L144 144M368 144L144 368"></path></svg>
            </button>
        </div>
        <p class="minicart__header--desc">Clothing and fashion products are limited</p>
    </div>

    <div class="minicart__product">
        @forelse($cart as $itemKey => $item)
            <div class="minicart__product--items d-flex">
                <div class="minicart__thumb">
                    <a href="{{ route('shop.show', $item['slug']) }}">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                    </a>
                </div>
                <div class="minicart__text">
                    <h3 class="minicart__subtitle h4">
                        <a href="{{ route('shop.show', $item['slug']) }}">{{ $item['name'] }}</a>
                    </h3>
                    @if(!empty($item['attributes']))
                        @foreach($item['attributes'] as $attribute => $value)
                            <span class="color__variant"><b>{{ $attribute }}:</b> {{ $value }}</span>
                        @endforeach
                    @endif
                    <div class="minicart__price">
                        <span class="current__price">${{ number_format($item['sale_price'] ?? $item['price'], 2) }}</span>
                        @if(isset($item['sale_price']) && $item['price'] > $item['sale_price'])
                            <span class="old__price">${{ number_format($item['price'], 2) }}</span>
                        @endif
                    </div>
                    <div class="minicart__text--footer d-flex align-items-center" x-data="{ quantity: {{
                    $item['quantity'] }} }">
                        <div class="quantity__box minicart__quantity">
                            <button type="button" class="quantity__value decrease"
                                    @click="quantity > 1 ? quantity-- : null; $wire.updateQuantity('{{ $itemKey }}', 'decrease')"
                                    :disabled="quantity <= 1">-</button>
                            <label>
                                <input type="number" class="quantity__number" x-model="quantity" readonly>
                            </label>
                            <button type="button" class="quantity__value increase"
                                    @click="quantity++; $wire.updateQuantity('{{ $itemKey }}', 'increase')">+</button>
                        </div>
                        <button class="minicart__product--remove"
                                @click="$wire.removeItem('{{ $itemKey }}')">Remove</button>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-4">
                <p>Your cart is empty</p>
            </div>
        @endforelse
    </div>

    <div class="minicart__amount">
        <div class="minicart__amount_list d-flex justify-content-between">
            <span>Total:</span>
            <span><b>${{ number_format($total, 2) }}</b></span>
        </div>
    </div>

    <div class="minicart__conditions text-center">

    </div>

    @if($itemCount > 0)
        <div class="minicart__button d-flex justify-content-center">
            <a class="primary__btn minicart__button--link" href="#">View cart</a>
            <a class="primary__btn minicart__button--link" href="#">Checkout</a>
        </div>
    @endif
</div>
