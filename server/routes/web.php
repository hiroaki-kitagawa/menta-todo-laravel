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

Route::group(['middleware' => 'auth'], function() {
    Route::get('todo', 'TodosController@index');
    Route::get('create', 'TodosController@create');
    Route::post('create', 'TodosController@store');
    Route::get('edit/{id}', 'TodosController@edit');
    Route::post('edit', 'TodosController@update');
    Route::post('/todo/destroy/{id}', 'TodosController@destroy');
    Route::get('/todo/csv', 'TodosController@export');

    Route::get('/', 'HomeController@index');
});
