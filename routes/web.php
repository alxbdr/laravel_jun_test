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

Route::redirect('/', '/list');

Auth::routes();

Route::get('/list', 'CodesController@list')->name('home');
Route::get('/create', 'CodesController@create');
Route::get('/delete', 'CodesController@delete');
