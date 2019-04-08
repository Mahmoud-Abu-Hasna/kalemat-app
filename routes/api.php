<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['namespace'=>'API'],function(){
    Route::get('categories','CategoryController@index');
    Route::get('categories/{id}/quotes','CategoryController@categoryQuotes');

    Route::get('quotes','QuoteController@index');
    Route::get('quotes/{id}','QuoteController@show');
    Route::get('quotes-by-tag/{tag}','QuoteController@quotesByTag');
    Route::post('make-fav/{id}/{status?}','QuoteController@fave');
    Route::get('random-quotes','QuoteController@randomQuotes');
    Route::get('random-quotes-lang/{lang}','QuoteController@quotesByLang');

    Route::get('next-quote-category/{cate_id}/{id}','QuoteController@nextInCategory');
    Route::get('prev-quote-category/{cate_id}/{id}','QuoteController@prevInCategory');
    Route::get('next-quote/{id}','QuoteController@nextQuote');
    Route::get('prev-quote/{id}','QuoteController@prevQuote');

    Route::post('new-user','UserController@store');
    Route::post('update-fcm-token','UserController@updateFCM');



});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
