<!-- Price Filter -->
<div class="single__widget price__filter widget__bg">
    <h2 class="widget__title h3">Filter By Price</h2>
    <form class="price__filter--form" wire:submit.prevent="applyPriceFilter">
        <div class="price__filter--form__inner mb-15 d-flex align-items-center">
            <div class="price__filter--group">
                <label class="price__filter--label" for="priceMin">From</label>
                <div class="price__filter--input border-radius-5 d-flex align-items-center">
                    <span class="price__filter--currency">$</span>
                    <input class="price__filter--input__field border-0"
                           wire:model.defer="priceMin"
                           type="number"
                           id="priceMin"
                           placeholder="{{ $minPrice }}"
                           min="{{ $minPrice }}"
                           max="{{ $maxPrice }}">
                </div>
            </div>
            <div class="price__divider">
                <span>-</span>
            </div>
            <div class="price__filter--group">
                <label class="price__filter--label" for="priceMax">To</label>
                <div class="price__filter--input border-radius-5 d-flex align-items-center">
                    <span class="price__filter--currency">$</span>
                    <input class="price__filter--input__field border-0"
                           wire:model.defer="priceMax"
                           type="number"
                           id="priceMax"
                           placeholder="{{ $maxPrice }}"
                           min="{{ $minPrice }}"
                           max="{{ $maxPrice }}">
                </div>
            </div>
        </div>
        <button class="price__filter--btn primary__btn" type="submit">Apply Filter</button>
    </form>
</div>
