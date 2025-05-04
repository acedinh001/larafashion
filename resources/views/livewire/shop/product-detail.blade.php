<div class="col">
    <div x-data="{ price: @entangle('price'), salePrice: @entangle('salePrice') }"
         class="product__details--info">
        <h2 class="product__details--info__title mb-15">{{ $product->title }}</h2>
        <div class="product__details--info__price mb-10">
            <span class="current__price" x-text="'$' + (price ?? salePrice)"></span>
            @if($salePrice)
                <span class="price__divided"></span>
                <span class="old__price" x-text="'$' + salePrice"></span>
            @endif
        </div>
        <div class="product__details--info__rating d-flex align-items-center mb-15">
            <ul class="rating d-flex justify-content-center">
                @for($i=0; $i <= 5; $i++)
                    <li class="rating__list">
                            <span class="rating__list--icon">
                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg"
                                     width="14.105" height="14.732" viewbox="0 0 10.105 9.732">
                                <path data-name="star - Copy"
                                      d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z"
                                      transform="translate(0 -0.018)" fill="currentColor"></path>
                                </svg>
                            </span>
                    </li>
                @endfor
            </ul>
            <span class="product__items--rating__count--number">(24)</span>
        </div>
        <p class="product__details--info__desc mb-15">
            {{ $product->description }}
        </p>
        <div class="product__variant">
            @foreach ($productAttributes as $attributeName => $values)
                <div class="product__variant--list mb-10">
                    <fieldset class="variant__input--fieldset">
                        <legend class="product__variant--title mb-8">{{ ucfirst($attributeName) }}</legend>
                        @foreach ($values as $value)
                            <input id="{{ $attributeName }}-{{ $value }}" name="{{ $attributeName }}"
                                   type="radio" wire:model.live.debounce.100ms="selectedAttributes.{{ $attributeName
                                   }}" value="{{
                                   $value }}">
                            <label class="variant__size--value" for="{{ $attributeName }}-{{ $value }}"
                                   title="{{ $value }}">{{ $value }}</label>
                        @endforeach
                    </fieldset>
                </div>
            @endforeach
            <div class="product__variant--list quantity d-flex align-items-center mb-20"
                 x-data="{ quantity: @entangle('quantity') }">
                <div class="quantity__box">
                    <button type="button"
                            class="quantity__value quickview__value--quantity decrease"
                            x-on:click="if (quantity > 1) quantity--">-</button>
                    <label>
                        <input type="number"
                               class="quantity__number quickview__value--number"
                               x-model="quantity"
                               readonly>
                    </label>
                    <button type="button"
                            class="quantity__value quickview__value--quantity increase"
                            x-on:click="quantity++">+</button>
                </div>
                <button class="quickview__cart--btn primary__btn"
                        type="button"
                        wire:click="addToCartFromDetail"
                        x-bind:disabled="quantity < 1"
                        wire:loading.attr="disabled">
                    <span>Add To Cart</span>
                </button>
            </div>
            <div class="product__variant--list mb-15">
                <a class="variant__wishlist--icon mb-15" href="wishlist.html"
                   title="Add to wishlist">
                    <svg class="quickview__variant--wishlist__svg"
                         xmlns="http://www.w3.org/2000/svg" viewbox="0 0 512 512">
                        <path
                            d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z"
                            fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="32"></path>
                    </svg>
                    Add to Wishlist
                </a>
                <button class="variant__buy--now__btn primary__btn" type="submit">Buy it now
                </button>
            </div>
        </div>
    </div>
</div>
