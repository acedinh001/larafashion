@extends('frontend.layouts.app')

@section('title', 'Home - Surichi Fashion')

@section('content')
    @include('frontend.home.sections.slider')
    @include('frontend.home.sections.categories')
    @include('frontend.home.sections.products')
    @include('frontend.home.sections.banner')
    @include('frontend.home.sections.product-grid')
    @include('frontend.home.sections.brand-logo')
    @include('frontend.home.sections.shop-cards')
    @include('frontend.home.sections.testimonials')
    @include('frontend.home.sections.contact')
    @include('frontend.home.sections.blog')
@endsection












