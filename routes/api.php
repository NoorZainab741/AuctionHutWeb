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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'API\Auth', 'prefix' => 'user'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

});
Route::group(['namespace' => 'API\Auth', 'prefix' => 'user', 'middleware' => 'auth.jwt'], function () {
    Route::post('profile', 'AuthController@profile');
    Route::post('viewProfile', 'AuthController@viewProfile');
});
Route::group(['namespace' => 'API', 'prefix' => 'user', 'middleware' => 'auth.jwt'], function () {

    Route::get('getAllCategories', 'CategoryController@getAllCategories');

    Route::get('getAllAuctions', 'AuctionController@getAllAuctions');
    Route::post('getAuctionsByCategories', 'AuctionController@getAuctionsByCategories');


//    Route::group(['namespace' => 'Orders', 'prefix' => 'orders'], function () {
//        Route::post('addToCart', 'OrderController@addToCart');
//        Route::post('completeOrder', 'OrderController@completeOrder');
//        Route::post('removeFromCart', 'OrderController@removeFromCart');
//        Route::post('onGoindOrders', 'OrderController@onGoindOrders');
//        Route::post('getCancelOrders', 'OrderController@getCancelOrders');
//        Route::post('getCompleteOrders', 'OrderController@getCompleteOrders');
//        Route::post('viewCart', 'OrderController@viewCart');
//        Route::post('SingleOrderCartDetails', 'OrderController@SingleOrderCartDetails');
//        Route::post('markOrderAsCancel', 'OrderController@markOrderAsCancel');
//        Route::post('markOrderAsComplete', 'OrderController@markOrderAsComplete');
//    });
});
