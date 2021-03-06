<?php

use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/codes/list');

Auth::routes();

Route::get('/user', 'UsersController@index')->name('profile');
Route::get('/user/delete', 'UsersController@delete')->middleware(['auth', 'password.confirm']);
Route::get('/user/edit', 'UsersController@edit')->middleware(['auth', 'password.confirm']);
Route::post('/user/destroy', 'UsersController@destroy');
Route::post('/user/update', 'UsersController@update');

Route::get('/codes/list', 'CodesController@list')->name('home');
Route::get('/codes/create', 'CodesController@create')->name('create');
Route::get('/codes/delete', 'CodesController@delete')->name('delete');

Route::post('/codes/store', 'CodesController@store');
Route::post('/codes/destroy', 'CodesController@destroy');