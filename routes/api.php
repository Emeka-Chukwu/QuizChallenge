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
Route::get('questions/{id}', 'ApiController@indexofindex')->name('questons');

Route::resource('questions','ApiController',['except' =>['edit','create','index','show']]);
Route::resource('challenges','ChallengesController',['except' => ['edit', 'create']]);
Route::get('challenges/challenge/{id}','ChallengesController@categorizeChallenge')->name('challenges.categorize');
Route::get('subjects','topicsController@subject')->name('subjects');
Route::get('topics/{id}', 'topicsController@topic')->name('topics');
Route::post('topics', 'topicsController@createTopic')->name('topics.store');
Route::post('subjects', 'topicsController@createSubject')->name('subject.store');
Route::get('questions/show/{id}','ApiController@show')->name('question.show');
