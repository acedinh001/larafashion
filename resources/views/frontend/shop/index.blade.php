@extends('frontend.layouts.app')

@section('title', 'Shop Left Sidebar - Suruchi Fashion')

@section('content')
    @include('frontend.shop.partials.breadcrumb')

    @include('frontend.shop.partials.mobile-filter')

    <!-- Start shop section -->
    <section class="shop__section section--padding">
        <div class="container-fluid">
            @include('frontend.shop.partials.top-filter', ['products' => $products])
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
                                            <a href="{{ $products->previousPageUrl() }}"
                                               class="pagination__item--arrow link {{ $products->onFirstPage() ? 'disabled' : '' }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443"
                                                     viewbox="0 0 512 512">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-width="48"
                                                          d="M244 400L100 256l144-144M120 256h292"></path>
                                                </svg>
                                                <span class="visually-hidden">Previous page</span>
                                            </a>
                                        </li>

                                        {{-- Pagination Elements --}}
                                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                            <li class="pagination__list">
                                                @if ($page == $products->currentPage())
                                                    <span
                                                        class="pagination__item pagination__item--current">{{ $page }}</span>
                                                @else
                                                    <a href="{{ $url }}" class="pagination__item link">{{ $page }}</a>
                                                @endif
                                            </li>
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        <li class="pagination__list">
                                            <a href="{{ $products->nextPageUrl() }}"
                                               class="pagination__item--arrow link {{ $products->hasMorePages() ? '' : 'disabled' }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443"
                                                     viewbox="0 0 512 512">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-width="48"
                                                          d="M268 112l144 144-144 144M392 256H100"></path>
                                                </svg>
                                                <span class="visually-hidden">Next page</span>
                                            </a>
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
@endsection
