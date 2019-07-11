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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['prefix' => 'v1'], function () {
    Route::post('/register', ['uses' => 'Auth\RegisterController@register', 'as' => 'api.v1.user.register']);
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('/courses/seed', ['uses' => 'CourseController@seed', 'as' => 'api.v1.courses.seed']);
        Route::post('/courses/user/register', ['uses' => 'CourseController@userRegister', 'as' => 'api.v1.courses.user.register']);
        Route::get('/courses', ['uses' => 'CourseController@index', 'as' => 'api.v1.courses.index']);
        Route::get('/courses/download/csv', ['uses' => 'CourseController@downloadCSV', 'as' => 'api.v1.courses.download.csv']);
    });
});
