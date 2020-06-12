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
Auth::routes();


Route::get('todo', 'TodosController@index')->name('todo');
Route::get('create', 'TodosController@create');
Route::post('create', 'TodosController@store');
Route::get('edit/{id}', 'TodosController@edit');
Route::post('edit', 'TodosController@update');

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
