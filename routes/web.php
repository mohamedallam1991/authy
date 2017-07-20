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

use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Auth::registerUser($request->user());

Route::get('/auth/token', 'Auth\AuthTokenController@getToken');
Route::post('/auth/token', 'Auth\AuthTokenController@postToken');
Route::get('/auth/token/resend', 'Auth\AuthTokenController@getResend');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/settings/twofactor', 'TwoFactorSettingsController@index');
    Route::put('/settings/twofactor', 'TwoFactorSettingsController@update');
});
