<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::get('/subscriptions', 'SubscriptionController@index');
Route::get('/home', 'HomeController@index');

Route::get('/events', 'EventController@index');

Route::get('/events/{id}', 'EventController@show');
Route::post('/events/{id}/regist/', 'EventController@registUser');


Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function () {
    Route::get(
        '/admin',
        function () {
            return view('admin.index');
        }
    );
});
Route::get('/admin/users', 'Admin\UserController@index');
Route::post('/admin/users/','Admin\UserController@registUser');//must be inside admin middleware


Route::group(['middleware' => 'App\Http\Middleware\EventManagerMiddleware'], function () {//only admins and event managers can do this
    Route::get('/user/events', 'UserController@eventManagement');
    Route::post('/events', 'EventController@create');
});
