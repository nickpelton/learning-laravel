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

// No controller
Route::get('/', function () {
    return view('welcome');
});

// Auth UI Routes
Auth::routes(['register' => false]); // Laravel Auth package, register disabled
// SSO Auth UI Socialite Routes
Route::get('login/{provider}', 'Auth\SocialLoginController@redirect');
Route::get('login/{provider}/callback','Auth\SocialLoginController@Callback');

// Dashboard UI Routes
Route::get('profile', 'ProfileController@index')->name('profile');

