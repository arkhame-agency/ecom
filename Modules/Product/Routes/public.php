<?php

use Illuminate\Support\Facades\Route;

Route::get(trans('product::routes.products', [], locale()), 'ProductController@index')->name('products.index');
Route::get(trans('product::routes.products/slug', [], locale()), 'ProductController@show')->name('products.show');

Route::get('promotions', 'ProductController@promotions')->name('products.promotions');

Route::get('suggestions', 'SuggestionController@index')->name('suggestions.index');

Route::post('products/{id}/price', 'ProductPriceController@show')->name('products.price.show');
