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
//root route
Route::get('/', 'WelcomeController@index');

Auth::routes();

//home
Route::get('/home', 'HomeController@index');

//subscriptions routes
Route::get('/subscriptions', 'SubscriptionController@index');
Route::post('/subscriptions/delete','SubscriptionController@cancel');

//events routes
Route::get('/events', 'EventController@index');
Route::get('/events/{id}', 'EventController@show');
Route::post('/events/{id}/regist/', 'EventController@registUser');

//admin only routes
Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function () {
    Route::get(
        '/admin',
        function () {
            return view('admin.index');
        }
    );
    Route::get('/admin/users', 'Admin\UserController@index');   //must be inside admin middleware

Route::get('/admin/users/register',function (Request $request) { return view('admin.users.register',compact('request'));});//must be inside admin middleware
Route::post('/admin/users/register','Admin\UserController@registUser');//must be inside admin middleware
});

//event manager/admin only routes
Route::group(['middleware' => 'App\Http\Middleware\EventManagerMiddleware'], function () {//only admins and event managers can do this
    Route::get('/user/events', 'UserController@eventManagement');
    Route::post('/events', 'EventController@create');
});
