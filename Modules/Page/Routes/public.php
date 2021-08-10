<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

Route::get('demande-soumissions', 'PageController@requestQuotations')->name('request.quotations');
Route::post('demande-soumissions', 'PageController@postRequestQuotations')->name('post.request.quotations');

Route::get('enregistrement-garantie', 'PageController@registrationGuarantee')->name('registration.guarantee');
Route::post('enregistrement-garantie', 'PageController@postRegistrationGuarantee')->name('post.registration.guarantee');
