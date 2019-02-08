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
    return view('index', [
    	'list' => App\ListModel::with('tasks')->first(),
    ]);
});

Route::get('/{id}', function($id) {
	return view('index', [
		'list' => App\ListModel::where('id', $id)->with('tasks')->first(),
	]);
});

Route::post('/check/{task}', 'ListController@check');

Route::post('/change/task/{task}', 'ListController@changeTask');
Route::post('/change/list/{list}', 'ListController@changeList');

Route::post('/new/list/', 'ListController@newList');
Route::post('/new/task/{list}', 'ListController@newTask');

Route::post('/delete/list/{list}', 'ListController@deleteList');
Route::post('/delete/task/{task}', 'ListController@deleteTask');
