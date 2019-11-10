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
Route::middleware('auth:api')->post('api/posts','PostController@api_add');
Route::middleware('auth:api')->get('api/posts/{id}','PostController@api_find');
Route::middleware('auth:api')->put('api/posts/{id}','PostController@changetatus');
Route::middleware('auth:api')->delete('api/posts/{id}','PostController@changetatus');

