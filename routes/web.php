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

Route::get('events/{slug}', ['as' => 'events.single', 'uses' => 'EventsController@getSingle'])->where('slug', '[\w\d\-\_]+');
Route::get('events', ['as' => 'events.index', 'uses' => 'EventsController@getIndex']);
Route::get('about', 'PagesController@getAbout');
Route::get('sponsorship', 'PagesController@getSponsors');
Route::get('/', 'PagesController@getIndex');
Route::resource('posts', 'PostController');
Route::resource('sponsors', 'SponsorController', ['except' => ['show']]);
Route::resource('categories', 'CategoryController', ['except' => ['create']]);
Route::resource('wikis', 'WikiController', ['except' => ['create']]);
Route::resource('subjects', 'SubjectController', ['except' => ['create']]);
Route::get('wikis/create/{year}', array('as' => 'wikis.create', 'uses' => 'WikiController@create'))->where('year', '[\d]+');
Route::get('answers/create/{wiki_id}', array('as' => 'answers.create', 'uses' => 'AnswerController@create'))->where('wiki_id', '[\d]+');