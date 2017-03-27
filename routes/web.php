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

/*
PAGES
*/
Route::get('/', 'PageController@home');
Route::get('/browse', 'PageController@browse');
Route::get('/share', 'PageController@share');
Route::get('/contact', 'PageController@contact');
Route::get('/cookies', 'PageController@cookies');
Route::get('/privacy', 'PageController@privacy');
Route::get('/about', 'PageController@about');
Route::get('/account', 'PageController@account');
//Messages
Route::get('/account/messages', 'PageController@messages');
Route::get('/account/messages/{message}', 'PageController@message');
Route::post('/account/messages', 'MessageController@store');

/*
REST API & forms
*/
//Food
Route::group(array('prefix' => 'api'), function() {
	Route::resource('foods', 'FoodController', ['except' => [
	    'create', 'edit'
	]]);
});
/* The above method is shorthand for:
Route::get('/api/foods', 'FoodController@index'); //Returns recently added foods
Route::get('/api/foods/{food}', 'FoodController@show'); //Returns a single food item with id == {food}
Route::post('/api/foods', 'FoodController@store'); //Store a new food
Route::delete('/api/foods/{food}', 'FoodController@destroy'); //Delete a food
Route::patch('/api/foods/{food}', 'FoodController@update'); //Edit a food
*/
Auth::routes();

Route::get('/home', 'HomeController@index');

/*
DEV
*/
Route::get('/dev/reset', function() {
	\App\User::truncate();
	\App\Food::truncate();
	\App\Message::truncate();
	echo "Done";
});
Route::get('/dev/users', function() {
	$users = \App\User::all();
	return response()->json(array(
		'data' => $users
	));
});