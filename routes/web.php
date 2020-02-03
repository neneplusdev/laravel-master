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

Route::get('login', [ 'as' => 'login', 'uses' => 'AuthController@index']);
Route::post('post-login', 'AuthController@postLogin'); 
Route::get('registration', 'AuthController@registration');
Route::post('post-registration', 'AuthController@postRegistration'); 
Route::get('dashboard', ['as'=>'dashboard', 'uses'=>'AuthController@dashboard']); 
Route::get('logout', 'AuthController@logout');

Route::get('/create/user','AuthController@create')->middleware('auth');
Route::delete('/delete/user/{id}','AuthController@destroy')->middleware('auth');
Route::get('/edit/user/{id}','AuthController@edit')->middleware('auth');
Route::post('/edit/user/{id}','AuthController@update')->middleware('auth');