<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

Route::get(trans('page::routes.request_quotation_url', [], locale()), 'PageController@requestQuotations')->name('request.quotations');
Route::post(trans('page::routes.request_quotation_url', [], locale()), 'PageController@postRequestQuotations')->name('post.request.quotations');

Route::get(trans('page::routes.register_guarantee_url', [], locale()), 'PageController@registrationGuarantee')->name('registration.guarantee');
Route::post(trans('page::routes.register_guarantee_url', [], locale()), 'PageController@postRegistrationGuarantee')->name('post.registration.guarantee');
