<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('demandes', 'PageController@demandes')->name('demandes');
Route::post('post-demandes', 'PageController@postDemandes')->name('postDemandes');
