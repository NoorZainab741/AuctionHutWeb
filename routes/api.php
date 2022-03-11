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
    Route::post('updateFcm', 'AuthController@updateFcm');
});
Route::group(['namespace' => 'API', 'prefix' => 'user', 'middleware' => 'auth.jwt'], function () {

    Route::get('getAllCategories', 'CategoryController@getAllCategories');

    Route::get('getAllAuctions', 'AuctionController@getAllAuctions');
    Route::post('getAuctionsByCategories', 'AuctionController@getAuctionsByCategories');
    Route::post('getAuctionDetails', 'AuctionController@getAuctionDetails');
    Route::post('createAuction', 'AuctionController@createAuction');
    Route::post('updateAuction', 'AuctionController@updateAuction');
    Route::post('deleteAuction', 'AuctionController@deleteAuction');
    Route::post('getSearchResults', 'AuctionController@getSearchResults');
    Route::post('createCheckoutSession', 'AuctionController@createCheckoutSession');
    Route::post('completeAuction', 'AuctionController@completeAuction');


    Route::post('getBidsForAuction', 'BidController@getBidsForAuction');
    Route::post('createBid', 'BidController@createBid');
    Route::post('acceptBid', 'BidController@acceptBid');
    Route::post('getUserBids', 'BidController@getUserBids');
    Route::post('updateBid', 'BidController@updateBid');
    Route::post('deleteBid', 'BidController@deleteBid');


    Route::post('getFeedbackForAuction', 'FeedbackController@getFeedbackForAuction');
    Route::post('createFeedback', 'FeedbackController@createFeedback');
});
