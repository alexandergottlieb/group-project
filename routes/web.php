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
Route::get('/home', 'PageController@home');
Route::get('/browse', 'PageController@browse');
Route::get('/share', 'PageController@share');
Route::get('/contact', 'PageController@contact');
Route::get('/cookies', 'PageController@cookies');
Route::get('/privacy', 'PageController@privacy');
Route::get('/about', 'PageController@about');
//Account
Route::get('/account', 'PageController@account');
Route::get('/account/food/{food}', 'PageController@food');
//Messages
Route::get('/account/messages', 'PageController@received');
Route::get('/account/messages/received/{from}', 'PageController@viewReceived');
Route::get('/account/messages/sent', 'PageController@sent');
Route::get('/account/messages/sent/{to}', 'PageController@viewSent');
Route::get('/messages/create/{food}', 'MessageController@create'); //Create a new message to the owner of a given food
Route::resource('/messages', 'MessageController', ['only' => [
    'store'
]]);

/*
REST API
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
... and so on for messages
*/

/*
Authentication - Login & Password etc.
*/
Auth::routes();

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
Route::get('/dev/food', function() {
	$food = \App\Food::all();
	return response()->json(array(
		'data' => $food
	));
});
Route::get('/dev/messages', function() {
	$data = \App\Message::all();
	return response()->json(array(
		'data' => $data
	));
});