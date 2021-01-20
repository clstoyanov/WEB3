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

Route::resource('/overview', 'OverviewController');

Route::resource('/lifehacks', 'CRUDController')->middleware('auth');

Route::get('index/export/', 'CRUDController@export');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::delete('user', 'HomeController@userDelete')->name('home.delete');

Route::patch('users/{user}/update',  ['as' => 'users.update', 'uses' => 'HomeController@update']);
Route::post('/home/update', 'HomeController@updateProfile')->name('home.update');