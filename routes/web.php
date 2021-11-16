<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/' , 'WelcomController@index')->name('welcom');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->where('provier' , 'facebook|google');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->where('provier' , 'facebook|google');
