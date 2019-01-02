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
Route::get('events/{id}','API\EventController@specificEvent');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('details', 'API\UserController@details');
});

Route::get('documentation', function(){
    foreach (Route::getRoutes()->getIterator() as $route){
        if (strpos($route->uri, 'api') !== false){
            if(in_array('GET',$route->methods)){
                $get_routes[] = $route->uri;
            }
            else if(in_array('POST',$route->methods)){
                $post_routes[] = $route->uri;
            }
            //$routes[] = $route->uri;
        }
    }
    return response()->json([
        'info'=> ["to make an authenticated request you must insert 2 headers",
            ["Accept: application/json","Authorization: Bearer <put here the token from the login or register post request>"]],
        'get routes' => $get_routes,
        'post_routes' => $post_routes
    ], 200);
});