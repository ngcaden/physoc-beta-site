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

Route::get('events_all', 'EventsController@index_all');
Route::resource('events', 'EventsController');
Route::resource('sponsors', 'SponsorController');
Route::resource('committee', 'CommitteeController');
Route::resource('categories', 'CategoryController');
Route::resource('courses', 'CourseController');