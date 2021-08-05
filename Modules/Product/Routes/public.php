<?php

use Illuminate\Support\Facades\Route;

Route::get('products', 'ProductController@index')->name('products.index');
Route::get('products/{slug}', 'ProductController@show')->name('products.show');

Route::get('promotions', 'ProductController@promotions')->name('products.promotions');

Route::get('suggestions', 'SuggestionController@index')->name('suggestions.index');

Route::post('products/{id}/price', 'ProductPriceController@show')->name('products.price.show');
