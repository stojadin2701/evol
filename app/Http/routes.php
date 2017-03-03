<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/', 'HomeController@index');

Route::get('/home', 'UserController@home')->middleware('auth');
Route::get('/feedback', 'UserController@feedback')->middleware('auth');
//Route::post('/feedback', 'UserController@postFeedback')->middleware('auth');
Route::post('/feedback/{category_name}', 'UserController@postFeedback')->middleware('auth');
Route::get('/user/{id}', 'UserController@viewUser');
Route::post('/user/{id}/addUserImage', 'UserController@addUserImage');
Route::post('/user/{id}/toggleBan', 'UserController@toggleBan');


Route::get('/mod', 'ModController@mod');
Route::post('/mod/deleteEvent', 'ModController@deleteEvent');
Route::post('/mod/approveEvent', 'ModController@approveEvent');
Route::post('/mod/deleteFeedback', 'ModController@deleteFeedback');

Route::get('/admin', 'AdminController@admin');
Route::post('/admin/search', 'AdminController@search');
Route::post('/admin/checkModStatus', 'AdminController@checkModStatus');
Route::post('/admin/changePrivileges', 'AdminController@changePrivileges');

Route::get('/event/create', 'EventController@createEvent')->middleware('auth');
Route::post('/event/create', 'EventController@postCreateEvent')->middleware('auth');
Route::get('/event/{event}/edit', 'EventController@editEvent')->middleware('auth');
Route::patch('/event/{event}/edit', 'EventController@patchEditEvent')->middleware('auth');
Route::get('/event/{id}', 'EventController@viewEvent');
Route::get('/event/{event}/signup', 'EventController@signup')->middleware('auth');
Route::get('/event/{event}/optout', 'EventController@optout')->middleware('auth');
Route::post('/event/{event}', 'EventController@addComment')->middleware('auth');
Route::get('/event/{id}/delete', 'EventController@deleteEvent')->middleware('auth');
Route::get('/event/{event}/track', 'EventController@trackParticipants')->middleware('auth');
Route::post('/event/{event}/track/{user}', 'EventController@postTrackParticipants')->middleware('auth');
