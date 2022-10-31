<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
* Web API routes
*/
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'API\V1'], function () {
    Route::get('display', 'UserApiController@display')->name('display');
    Route::put('update', 'UserApiController@update')->name('update');
    Route::get('csvExport', 'UserApiController@csvExport')->name('csvExport');
});
