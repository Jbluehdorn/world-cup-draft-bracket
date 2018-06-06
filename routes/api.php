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

Route::get('/users', function() {return 'hello';});

Route::group([
    'namespace' => 'Api',
], function() {
    Route::get('users/{sub}/score', 'UsersController@getScore');
    Route::get('users/{sub}/teams', 'UsersController@getTeams');
    Route::get('teams/top', 'TeamsController@getTopTen');

    Route::resource('users', 'UsersController');
    Route::resource('teams', 'TeamsController');
});