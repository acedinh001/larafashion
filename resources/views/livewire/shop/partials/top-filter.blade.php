<div class="shop__header bg__gray--color d-flex align-items-center justify-content-between mb-30">
    {{--    Mobile Button   --}}
    <button class="widget__filter--btn d-flex d-lg-none align-items-center" data-offcanvas="">
        <svg class="widget__filter--btn__icon" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28" d="M368 128h80M64 128h240M368 384h80M64 384h240M208 256h240M64 256h80"></path><circle cx="336" cy="128" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28"></circle><circle cx="176" cy="256" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28"></circle><circle cx="336" cy="384" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28"></circle></svg>
        <span class="widget__filter--btn__text">Filter</span>
    </button>

    <div class="product__view--mode d-flex align-items-center">
        <div class="product__view--mode__list product__short--by align-items-center d-none d-lg-flex">
            <label class="product__view--label">Per Page :</label>
            <div class="select shop__header--select">
                <select wire:model.live="perPage" class="product__view--select">
                    <option value="12">12</option>
                    <option value="24">24</option>
                    <option value="36">36</option>
                    <option value="48">48</option>
                </select>
            </div>
        </div>
        <div class="product__view--mode__list product__short--by align-items-center d-none d-lg-flex">
            <label class="product__view--label">Sort By :</label>
            <div class="select shop__header--select">
                <select wire:model.live="sortBy" class="product__view--select">
                    <option value="latest">Sort by latest</option>
                    <option value="popularity">Sort by popularity</option>
                    <option value="price_asc">Price: Low to High</option>
                    <option value="price_desc">Price: High to Low</option>
                </select>
            </div>
        </div>
        <div class="product__view--mode__list product__view--search d-none d-lg-block">
            <form class="product__view--search__form" action="#">
                <label>
                    <input wire:model.live.debounce.300ms="search"
                           class="product__view--search__input border-0"
                           placeholder="Search by"
                           type="text">
                </label>
                <button class="product__view--search__btn d-flex align-items-center justify-content-center" aria-label="shop button" type="submit">
                    <svg class="product__view--search__btn--svg" xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewbox="0 0 512 512"><path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"></path></svg>
                </button>
            </form>
        </div>
    </div>
    <p class="product__showing--count">
        Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} results
    </p>
</div>
