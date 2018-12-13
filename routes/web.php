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

Route::get('/ee', function () {
    return view('/layouts.layout');
});

Auth::routes();
Route::get('/subscriptions','SubscriptionController@index');
Route::get('/home','HomeController@index');
// Route::post('/notes','NotesControler@add');
// Route::get('/notes/first','NotesControler@getFirst');

Route::get('/events','EventController@index');
Route::post('/events','EventController@create');
Route::get('/events/{id}','EventController@show');
// Route::post('/events/{id}/regist/','EventsController@registUser');
