<?php

use App\Enums\EntityEnums;

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

Route::get('/', function () {
    return redirect()->route(EntityEnums::DASHBOARD);
});

Route::group(['namespace' => 'Open'], function() {
    Route::get(EntityEnums::GET_ACCOUNT_KEY, 'ApiController@getAccountKey');

    Route::group(['middleware' => 'auth'], function() {
        /**
         * Private API calls
         */
        Route::get(EntityEnums::GET_USER_INFO, 'ApiController@getUserInfo')->name(EntityEnums::GET_USER_INFO);
        Route::get(EntityEnums::FOLLOW_USER.'/{entity}', 'ApiController@followUser')->name(EntityEnums::FOLLOW_USER);
        
        /**
         * Public API calls
         */
        Route::get(EntityEnums::FIND_USERNAME.'/{entity}', 'ApiController@findUsername')->name(EntityEnums::FIND_USERNAME);
        Route::get(EntityEnums::FIND_HASHTAG.'/{entity}', 'ApiController@findHashtag')->name(EntityEnums::FIND_HASHTAG);

        Route::group(['middleware' => 'check.connected.account'], function() {
            Route::get(EntityEnums::DASHBOARD, 'PagesController@'.EntityEnums::DASHBOARD)->name(EntityEnums::DASHBOARD);
        });

        Route::group([], function() {
            Route::get(EntityEnums::ACCOUNTS, 'PagesController@'.EntityEnums::ACCOUNTS)->name(EntityEnums::ACCOUNTS);
        });
    });
});
