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

Route::get('/', 'PostsController@index');

Route::get('/img/{img}', 'PostsController@viewImg');

Route::get('/upload', 'PostsController@upload');

Route::get('/all', 'PostsController@viewAll');

Route::any('/search', 'PostsController@search');

Route::post('/store', 'PostsController@store')->name('posts.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
