<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Suruchi')</title>
    <meta name="description" content="@yield('meta_description', 'Modern Bootstrap HTML5 Template')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <!-- ======= All CSS Plugins here ======== -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/glightbox.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet">
    <!-- Plugin css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @livewireStyles
</head>
<body>
@include('frontend.layouts.partials.preload')
@include('frontend.layouts.partials.header')

<main class="main__content_wrapper">
    @yield('content')
</main>

@include('frontend.layouts.partials.footer')
@include('frontend.layouts.partials.newsletter-popup')
@include('frontend.layouts.partials.quickview-modal')
@include('frontend.layouts.partials.scroll-top')
@include('frontend.layouts.partials.scripts')
    @livewireScripts
</body>
</html>
