<?php

use Illuminate\Support\Facades\Route;

Route::get('categories', 'CategoryController@index')->name('categories.index');

Route::get(trans('category::routes.categories/slug/products', [], locale()), 'CategoryProductController@index')->name('categories.products.index');
