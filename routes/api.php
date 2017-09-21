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

// Events
Route::resource('events', 'EventsController');
Route::get('events_all', 'EventsController@index_all');

// Sponsors
Route::resource('sponsors', 'SponsorController');

// Committee Members
Route::resource('committee', 'CommitteeController');

// Event Categories
Route::resource('categories', 'CategoryController');

// Wiki
Route::resource('courses', 'CourseController');
Route::resource('usefullinks', 'UsefulLinkController');
Route::resource('coursenotes', 'CourseNoteController');
Route::resource('pastpapers', 'PastPaperController');
Route::get('uniquesets/{course_id}', 'CourseNoteController@showUniqueSets');