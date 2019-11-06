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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/data', 'HomeController@index')->name('data');
Route::get('/calendar', 'HomeController@index')->name('calendar');
Route::get('/recordadd', 'HomeController@index')->name('recordadd');
Route::get('/types', 'HomeController@types')->name('types');

Route::get('/targets/create', 'TargetController@create')->name('target.create');
Route::post('/targets', 'TargetController@store')->name('target.store');
Route::delete('/targets/{target}', 'TargetController@destroy');

Route::resource('workout-types', 'WorkoutTypeController');
Route::resource('food-types', 'FoodTypeController');
