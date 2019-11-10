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
Route::get('/success', function(){
  return view('success');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/stats', 'HomeController@stats');
Route::get('/calendar', 'HomeController@calendar');
Route::get('/recordadd', 'HomeController@recordAdd');
Route::get('/types', 'HomeController@types');


Route::get('/targets/create', 'TargetController@create');
Route::post('/targets', 'TargetController@store');
Route::delete('/targets/{target}', 'TargetController@destroy');

Route::resource('workout-types', 'WorkoutTypeController');
Route::resource('food-types', 'FoodTypeController');

Route::post('/workouts', 'RecordController@workout');
Route::post('/foods', 'RecordController@food');
Route::post('/moods', 'RecordController@mood');
Route::post('/sleeps', 'RecordController@sleep');
Route::post('/weights', 'RecordController@weight');
