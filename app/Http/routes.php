<?php

use App\Goal;
use App\Category;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('front.pages.home');
});

// Views
Route::get('fill', function() { return view('front.pages.fill'); })->middleware('auth');
Route::get('leaderboards', function() { return view('front.pages.leaderboards'); });

// Endpoints
Route::group(['prefix' => 'goals'], function() {
	Route::get('list', 'GoalController@getGoals');
	Route::get('toggle/{id}', 'GoalController@toggleGoal')->middleware('auth');
});

Route::group(['prefix' => 'stats'], function() {
	Route::get('leaderboards/all', 'StatsController@getAllLeaderboards');
});

Route::get('/categories/list', function() {
	return Category::all();
});

// Backend
Route::group(['prefix' => 'back', 'middleware' => ['auth']], function() {
	// Views
	Route::get('/', function() { return view('back.pages.root'); });
	Route::get('goals', function() { return view('back.pages.goals'); });

	// Endpoints
	Route::resource('goal', 'Back\GoalController');
	Route::resource('category', 'Back\CategoryController');
});


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Debug routes
Route::get('pop', function()
{
	$basic = Category::create(['name' => 'The Basics', 'weight' => 1]);
	$bonus = Category::create(['name' => 'Bonus Points', 'weight' => 1]);

	$goals = ['Slept 6-8 hours last night', 'Exercised for at least 30 mins', 'Drank at least 4 glasses of water', 'Ate a healthy lunch'];

	foreach ($goals as $goal) {
		Goal::create(['name' => $goal, 'category_id' => $basic->id, 'points' => 10]);
	}

	$goals = ['Purposeful exercise (run, gym, etc.)', 'Ate home-cooked dinner', 'Avoided caffeine', 'Avoided refined sugar (treats)', 'Took 2 or more breaks from screen'];

	foreach ($goals as $goal) {
		Goal::create(['name' => $goal, 'category_id' => $bonus->id, 'points' => 15]);
	}

	return Category::all();
});