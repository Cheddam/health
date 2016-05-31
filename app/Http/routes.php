<?php

use App\Goal;
use App\Category;

Route::get('/', function () {
    return view('front.pages.home');
});

// Profiles
Route::controller('profile', 'ProfileController');


// Laravel's 'RedirectsUsers' trait has a very poor default
Route::get('home', function() {
	return Redirect::to('/');
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
Route::group(['prefix' => 'back', 'middleware' => ['auth', 'admin']], function() {
	// Views
	Route::get('/', function() { return view('back.pages.root'); });

	// Endpoints
	Route::resource('goals', 'Back\GoalController');
	Route::resource('categories', 'Back\CategoryController');
});


// Authentication routes
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password Reset routes
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');