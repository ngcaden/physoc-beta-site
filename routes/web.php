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

// Pages
Route::get('about', 'PagesController@getAbout');
Route::get('sponsorship', 'PagesController@getSponsorship');
Route::get('wiki', 'PagesController@getWiki');
Route::get('/', 'PagesController@getIndex');

// Admin Pages
Route::get('manage_events', 'PagesController@getManageEvents');
Route::get('sponsors', 'PagesController@getSponsors');

// Login
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
