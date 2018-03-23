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
	return view('auth/login');
});

Route::middleware('auth')->group( function() {
	Route::get('/runs', "RunController@index")->name("runs");
	Route::get('/runs/new', "RunController@newRun")->name("new_run");
	Route::post('/runs/new', "RunController@newRun")->name("create_run");
	Route::get('/runs/{run_id}', "RunController@show")->name("run_details");
	Route::post('/runs/{run_id}', "RunController@modify")->name("update_run");
	Route::delete('/run/{run_id}/delete', "RunController@delete")->name("delete_run");

	Route::get('/jars/{run_id}', "JarController@index")->name("jars");
	Route::post('/jars/{run_id}/new', "JarController@newJar")->name("create_jar");
	Route::get('/jars/{run_id}/new', "JarController@newJar")->name("new_jar");
	Route::get('/jar/{jar_id}', "JarController@show")->name("jar_details");
	Route::post('/jar/{jar_id}', "JarController@modify")->name("update_jar");

	Route::post('/jar/{jar_id}/toggle_favorite/', "JarController@toggleFavorite");
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/generate/password', function() { return bcrypt("secret"); });
