@extends('frontend.layouts.app')

@section('title', 'Shop Left Sidebar - Suruchi Fashion')

@section('content')

    @include('frontend.shop.partials.mobile-filter')

   <livewire:shop.product-list :products="$products"/>

@endsection
