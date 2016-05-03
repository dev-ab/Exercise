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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();
Route::post('/login', 'Auth\AuthController@authenticate');
Route::get('/home', 'ManagerController@index');
Route::get('/profile/{id?}', 'ManagerController@view_profile');
Route::get('/view-users', 'ManagerController@view_users');
