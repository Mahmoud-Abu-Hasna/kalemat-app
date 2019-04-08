<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/', 'HomeController@index')->name('user.home');
Route::get('/category/{id}', 'HomeController@byParentCategory')->name('home.byParentCategory');
Route::get('/sub-category/{id}', 'HomeController@byCategory')->name('home.byCategory');
Route::post('/subscribe', 'HomeController@subscribe')->name('home.subscribe');
Route::get('/un-subscribe/{token}', 'HomeController@unsubscribe')->name('home.unsubscribe');
Route::get('/visits/{id}', 'HomeController@linkClick')->name('link.visits');

Route::get('images/{type}/{size}/{id}', ['as' => 'image', 'uses' => 'ImageHandler@getPublicImage']);
Route::get('image_r/{size}/{id}', ['as' => 'image', 'uses' => 'ImageHandler@getImageResize']);
Route::get('images/{type}/{id}', ['as' => 'image', 'uses' => 'ImageHandler@getDefaultImage']);