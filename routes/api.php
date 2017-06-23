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

Route::middleware('auth:api')->get('/connected_user', function (Request $request) {
    return $request->user();
});

Route::middleware('oauthclient')->get('/connected_oautclient', function (Request $request) {
    return $request->offsetGet('passportClient');
});


Route::resource('user','UserController');
Route::resource('client','ClientController');

Route::get('search','SearchController@ClientUserSearch');