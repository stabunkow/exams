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
    Route::put('/authorizations/current', 'AuthorizationsController@update');
    Route::delete('/authorizations/current', 'AuthorizationsController@destroy');

    Route::namespace('User')->prefix('user')->group(function () {
        Route::get('', 'UserController@index');
        Route::get('/wrong_questions', 'WrongQuestionsController@index');
        Route::get('/favorite_questions', 'FavoriteQuestionsController@index');
        Route::get('/exercise_books', 'ExerciseBooksController@index');
    });
    Route::namespace('ExerciseBooks')->prefix('exercise_books')->group(function () {
        Route::get('{exercise_book}', 'ExerciseBooksController@show');
        Route::get('{exercise_book}/questions', 'QuestionsController@index');
        Route::post('{exercise_book}/record', 'RecordController@create');
    });
    Route::namespace('Questions')->prefix('questions')->group(function () {
        Route::post('{question}/star', 'QuestionsController@star');
        Route::post('{question}/unstar', 'QuestionsController@unstar');
    });

});

Route::namespace('Api')->middleware('auth:api')->group(function () {

});
