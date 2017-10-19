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

Route::resource('events', 'EventsController', ['except' => ['show','edit','create']]);
Route::get('events_all', 'EventsController@index_all');
Route::resource('sponsors', 'SponsorController', ['except' => ['show','edit','create']]);
Route::resource('committee', 'CommitteeController');
Route::resource('categories', 'CategoryController');
Route::resource('courses', 'CourseController', ['except' => ['destroy','edit','create']]);
Route::resource('usefullinks', 'UsefulLinkController', ['except' => ['destroy','edit','create']]);
Route::resource('coursenotes', 'CourseNoteController', ['except' => ['create', 'edit', 'destroy']]);
Route::resource('pastpapers', 'PastPaperController', ['except' => ['destroy','edit','create']]);
Route::get('paper/{paper_id}', 'PastPaperController@show_individual')->where('paper_id', '[\d]+');
Route::get('uniquesets/{course_id}', 'CourseNoteController@showUniqueSets')->where('course_id', '[\d]+');
Route::resource('solutions', 'SolutionController', ['except' => ['index','destroy','create','edit','update']]);
