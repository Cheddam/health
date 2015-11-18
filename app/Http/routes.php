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
    return view('welcome');
});

// Views
Route::get('fill', function() { return view('pages.fill'); });

// Endpoints
Route::group(['prefix' => 'goals'], function() {
	Route::get('list', 'GoalController@getGoalsByCategory');
	Route::get('completed', 'GoalController@getCompletedGoals');
	Route::post('complete/{id}', 'GoalController@completeGoal');
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