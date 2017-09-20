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
Route::get('/', 'PagesController@getIndex');

// Admin Pages
Route::get('posts', 'PagesController@getPosts');
Route::get('sponsors', 'PagesController@getSponsors');

// Wiki
Route::resource('wikis', 'WikiController', ['except' => ['create']]);
Route::get('wikis/create/{year}', array('as' => 'wikis.create', 'uses' => 'WikiController@create'))->where('year', '[\d]+');
Route::get('answers/create/{wiki_id}', array('as' => 'answers.create', 'uses' => 'AnswerController@create'))->where('wiki_id', '[\d]+');

// Login
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
