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

Route::namespace('Api')->group(function () {
    Route::get('/headlines', 'HeadlinesController@index');
    Route::get('/subjects', 'SubjectsController@index');
    Route::get('/sections', 'SectionsController@index');

    Route::namespace('ExerciseBooks')->prefix('exercise_books')->group(function () {
        Route::get('', 'ExerciseBooksController@index');
    });

    Route::post('/authorizations', 'AuthorizationsController@store');
    Route::put('/authorizations/current', 'AuthorizationsController@store');
    Route::delete('/authorizations/current', 'AuthorizationsController@destroy');
});

Route::namespace('Api')->middleware('auth:api')->group(function () {
    Route::namespace('User')->prefix('user')->group(function () {
        Route::get('', 'UserController@index');
    });
    Route::namespace('ExerciseBooks')->prefix('exercise_books')->group(function () {
        Route::get('{exercise_book}', 'ExerciseBooksController@show');
        Route::get('{exercise_book}/questions', 'QuestionsController@index');
    });
});
