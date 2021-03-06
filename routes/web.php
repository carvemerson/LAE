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
// Route::group(['prefix' => 'machine'], function ()
// {
// 	Route::get('status', 'MachineController@status');

// 	Route::get('show', 'MachineController@show');

// 	Route::get('new', 'MachineController@create');
// 	Route::post('new', 'MachineController@store');

// 	Route::get('edit/{id}', 'MachineController@edit');
// 	Route::post('edit/{id}', 'MachineController@save');

// 	Route::get('delete/{id}', 'MachineController@destroy');
// });


Route::get('/', 'NewMachineController@index')->name('home');	
Route::get('/ping', 'NewMachineController@ping')->name('ping');


Route::group(['middleware' => 'auth'], function(){
	
	Route::get ('/new', 'NewMachineController@create')->name('create_machine');
	Route::post('/new', 'NewMachineController@store')->name('store_machine');

	Route::get ('/show', 'NewMachineController@show')->name('show_machine');

	Route::get ('/edit/{machine}', 'NewMachineController@edit')->name('edit_machine');
	Route::post('/edit/{machine}', 'NewMachineController@update')->name('update_machine');

	Route::get('/delete/{machine}', 'NewMachineController@destroy')->name('destroy_machine');

	Route::get('/status', 'NewMachineController@status')->name('status_machine');
});

Auth::routes();

