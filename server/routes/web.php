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

// Route::get('todos/{id}', 'TodoController@show');
// Route::post('todos', 'TodoController@store');
// Route::put('todos/{id}', 'TodoController@update');
// Route::delete('todos/{id}', 'TodoController@destroy');
// Route::get('todos', 'TodoController@index')->name('todos.index');
// Route::get('todos/create', 'TodoController@create')->name('todos.create');
// Route::get('todos/{id}/edit', 'TodoController@edit')->name('todos.edit');

Route::resource('todos', 'TodoController');
