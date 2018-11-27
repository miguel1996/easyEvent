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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/subscriptions','SubscriptionController@index');
Route::get('/home','HomeController@index');
// Route::post('/notes','NotesControler@add');
// Route::get('/notes/first','NotesControler@getFirst');

// Route::get('/events','EventsController@index');
// Route::post('/events','EventsController@addEvent');
// Route::get('/events/{id}','EventsController@showDetails');
// Route::post('/events/{id}/regist/','EventsController@registUser');
