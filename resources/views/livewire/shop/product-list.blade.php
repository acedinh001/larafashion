<!-- Start shop section -->
<section class="shop__section section--padding">
    <div class="container-fluid">
        @include('livewire.shop.partials.top-filter')
        <div class="row">
            @include('frontend.shop.partials.sidebar-filter')
            <div class="col-xl-9 col-lg-8">
                <div class="shop__product--wrapper">
                    <div class="tab_content">
                        <div id="product_grid" class="tab_pane active show">
                            <div class="product__section--inner product__grid--inner">
                                <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-2 mb--n30">
                                    @forelse($products as $product)
                                        @include('livewire.shop.partials.product-card', ['product' => $product])
                                    @empty
                                        <p>No products found.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('livewire.shop.partials.pagination')
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End shop section -->
