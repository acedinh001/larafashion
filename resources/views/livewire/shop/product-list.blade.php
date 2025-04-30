<!-- Start shop section -->
<section class="shop__section section--padding">
    <div class="container-fluid">
        @include('frontend.shop.partials.top-filter')
        <div class="row">
            @include('frontend.shop.partials.sidebar-filter')
            <div class="col-xl-9 col-lg-8">
                <div class="shop__product--wrapper">
                    <div class="tab_content">
                        <div id="product_grid" class="tab_pane active show">
                            <div class="product__section--inner product__grid--inner">
                                <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-2 mb--n30">
                                    @forelse($products as $product)
                                        @include('frontend.shop.partials.product-card', ['product' => $product])
                                    @empty
                                        <p>No products found.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pagination__area bg__gray--color">
                        @if ($products->hasPages())
                            <nav class="pagination justify-content-center">
                                <ul class="pagination__wrapper d-flex align-items-center justify-content-center">
                                    {{-- Previous Page Link --}}
                                    <li class="pagination__list">
                                        <button wire:click="previousPage"
                                                @if($products->onFirstPage()) disabled @endif
                                                class="pagination__item--arrow link {{ $products->onFirstPage() ? 'disabled' : '' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443"
                                                 viewbox="0 0 512 512">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="48"
                                                      d="M244 400L100 256l144-144M120 256h292"></path>
                                            </svg>
                                            <span class="visually-hidden">Previous page</span>
                                        </button>
                                    </li>

                                    {{-- Pagination Elements --}}
                                    @foreach ($products->links()->elements[0] as $page => $url)
                                        <li class="pagination__list">
                                            <button wire:click="gotoPage({{ $page }})"
                                                    class="pagination__item link {{ $page == $products->currentPage() ? 'pagination__item--current' : '' }}">
                                                {{ $page }}
                                            </button>
                                        </li>
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    <li class="pagination__list">
                                        <button wire:click="nextPage"
                                                @if(!$products->hasMorePages()) disabled @endif
                                                class="pagination__item--arrow link {{ $products->hasMorePages() ? '' : 'disabled' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443"
                                                 viewbox="0 0 512 512">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="48"
                                                      d="M268 112l144 144-144 144M392 256H100"></path>
                                            </svg>
                                            <span class="visually-hidden">Next page</span>
                                        </button>
                                    </li>
                                </ul>
                            </nav>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End shop section -->
