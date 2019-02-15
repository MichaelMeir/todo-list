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

Route::get('/', 'HomeController@index')->middleware('auth');

Route::get('/home', 'HomeController@index')->middleware('auth');

Route::get('/login', 'AuthController@index')->middleware('guest')->name('login');
Route::post('/login', 'AuthController@login')->middleware('guest')->name('login');
Route::get('/logout', 'AuthController@logout');
Route::get('/register', function() {
	return view('auth.register');
});

Route::get('/{id}', function($id) {
	return view('list', [
		'list' => App\ListModel::where('id', $id)->with('tasks')->first(),
	]);
})->middleware('auth');

Route::post('/check/{task}', 'ListController@check')->middleware('auth');

Route::post('/change/task/{task}', 'ListController@changeTask')->middleware('auth');
Route::post('/change/list/{list}', 'ListController@changeList')->middleware('auth');

Route::post('/change/role/{role}/{user}', 'RoleController@setRole')->middleware('auth');

Route::post('/new/list/', 'ListController@newList')->middleware('auth');
Route::post('/new/task/{list}', 'ListController@newTask')->middleware('auth');

Route::post('/delete/list/{list}', 'ListController@deleteList')->middleware('auth');
Route::post('/delete/task/{task}', 'ListController@deleteTask')->middleware('auth');

Auth::routes();
