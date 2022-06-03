<?php

use Illuminate\Support\Facades\Route;

Route::get(trans('brand::routes.brands', [], locale()), 'BrandController@index')->name('brands.index');
Route::get(trans('brand::routes.brands/slug/products', [], locale()), 'BrandProductController@index')->name('brands.products.index');
