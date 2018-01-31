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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['refresh.main']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});

// Route to auth in Main APIAuthCmp
Route::group(['middleware' => ['auth']], function () {
    // redirect to Main app auth url
    Route::get('/auth/main', 'API\MainAuthController@redirect');
    // redirect from Main app after success with code needed to grab access_token
    Route::get('/auth/main/callback', 'API\MainAuthController@callback');
    // refresh access_token if expired
    Route::get('/auth/main/refresh', 'API\MainAuthController@refresh');
});
