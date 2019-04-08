<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud
 * Date: 3/4/2019
 * Time: 3:56 PM
 */


Route::group(['prefix' => 'admin', 'namespace'=>'Admin'], function () {

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/index', 'HomeController@index')->name('home');
        Route::get('/categories', 'CategoryController@index')->name('admin.categories');
        Route::post('/categories','CategoryController@store')->name('admin.post-category');
        Route::post('/categories/update','CategoryController@update')->name('admin.update-category');
        Route::post('/categories/delete', 'CategoryController@delete')->name('admin.categories.delete');
        Route::get('/categories/show/{id}', 'CategoryController@show')->name('admin.categories.show');
        Route::get('/categories/{id}/quotes', 'CategoryController@quotes')->name('admin.quotes');

        Route::get('/quotes', 'QuoteController@index')->name('quotes');
        Route::post('/quotes','QuoteController@store')->name('admin.post-quote');
        Route::post('/quotes/update','QuoteController@update')->name('admin.update-quote');
        Route::get('/quotes/show/{id}', 'QuoteController@show')->name('admin.quotes.show');
        Route::post('/quotes/delete', 'QuoteController@delete')->name('admin.quotes.delete');


        Route::post('/notify', 'HomeController@notify')->name('notify');



    });

    Route::group(['namespace' => 'Auth'], function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
        Route::post('/login', 'LoginController@login')->name('admin.postLogin');
        Route::get('/logout', 'LoginController@logout');
    });


});
