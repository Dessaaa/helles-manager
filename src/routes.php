<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
  return View::make('hello');
});

Route::get('admin/logout',  array('as' => 'admin.logout',     'uses' => 'Tresyz\HellesManager\Admin\AuthController@getLogout'));
Route::get('admin/login',   array('as' => 'admin.login',      'uses' => 'Tresyz\HellesManager\Admin\AuthController@getLogin'));
Route::post('admin/login',  array('as' => 'admin.login.post', 'uses' => 'Tresyz\HellesManager\Admin\AuthController@postLogin'));

Route::group(array('prefix' => 'admin', 'before' => 'auth.admin'), function()
{
  Route::any('/',array('as' => 'admin.dashboard',      'uses' => 'Tresyz\HellesManager\Admin\DashboardController@index'));
  Route::resource('user', 'Tresyz\HellesManager\Admin\UserController');
});