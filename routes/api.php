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
    Route::resource('users', 'UsersController');
    Route::resource('teams', 'TeamsController');
});