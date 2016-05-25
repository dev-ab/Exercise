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
Route::post('/login', 'Auth\AuthController@authenticate');
Route::get('/', 'ManagerController@index');
Route::get('/profile/{id?}', 'ManagerController@view_profile');
Route::get('/view-users', 'ManagerController@view_users');
Route::post('/save-info/{id?}', 'ManagerController@save_info');
Route::post('/save-avatar/{id?}', 'ManagerController@save_avatar');
Route::get('/reload-user/{id}', 'ManagerController@reload_user');
Route::post('/save-password/{id}', 'ManagerController@save_password');
Route::post('/save-group/{id}', 'ManagerController@save_group');
Route::post('/save-project/{id}', 'ManagerController@save_project');
Route::post('/delete-project/{id}', 'ManagerController@delete_project');
Route::post('/delete-att/{id}', 'ManagerController@delete_att');
Route::post('/delete-user/{id}', 'ManagerController@delete_user');
Route::get('/view-groups', 'ManagerController@view_groups');
Route::post('/update-group/{id}', 'ManagerController@update_group');
Route::get('/delete-group/{id}', 'ManagerController@delete_group');
Route::get('/reload-groups', 'ManagerController@reload_groups');

//files routes
Route::get('img/{path?}', 'FilesController@view')->where('path', '(.*)');

