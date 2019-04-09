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

Route::post('pois', 'ApiController@pois')->name('api.pois');

Route::prefix('v1')->group(function () {
    Route::post('hospitals', 'ApiController@getHospitals');
    Route::post('pitches', 'ApiController@getPitches');
    Route::post('secondaries', 'ApiController@getSecondaries');
});