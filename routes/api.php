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

/*
| a post request must have 2 headers:
| Accept: application/json
| Authorization: Bearer <the token from the login or register>
*/

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::get('events','API\EventController@allEvents');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('details', 'API\UserController@details');
});

Route::get('documentation', function(){
    foreach (Route::getRoutes()->getIterator() as $route){
        if (strpos($route->uri, 'api') !== false){
            $routes[] = $route;
        }
    }
    return response()->json(['routes' => $routes], 200);
});