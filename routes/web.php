<?php

use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.index');
})->name('home');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/{product:slug}', [ShopController::class, 'show'])->name('shop.show');

Route::get('/about', function () {
    return 'about';
})->name('about');

Route::get('/blog', function () {
    return 'blog';
})->name('blog');

Route::get('/contact', function () {
    return 'contact';
})->name('contact');
