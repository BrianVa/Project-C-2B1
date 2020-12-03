<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Admin
Route::get('/gebruikers','EmployeeController@EmployeeView')->middleware('auth', 'admin');
Route::get('/gebruiker/{id}', 'EmployeeController@EmployeeDetails')->middleware('auth', 'admin');
Route::post('/updategebruiker', 'EmployeeController@UpdateEmployee')->middleware('auth', 'admin');

//Medewerker
Route::get('/dashboard', 'MainController@DashboardView')->middleware('auth', 'employee');
Route::get('/profiel', 'ProfileController@ProfileView')->middleware('auth', 'employee');
Route::post('/updatedata', 'ProfileController@UpdateUserData')->middleware('auth', 'employee');

//General
Route::post('/loggingin', 'MainController@checklogin');
Route::post('/register', 'MainController@register');
Route::get('/logout', 'MainController@logout')->middleware('auth', 'employee');
Route::get('/', 'MainController@LoginView');

//Knowledgesessions
Route::get('/kennissessies', 'KnowledgesessionController@KnowledgesessionView')->middleware('auth', 'employee');
Route::get('/kennissessies/toevoegen', 'KnowledgesessionController@addView')->middleware('auth', 'facilitator');
Route::post('/addingsession', 'KnowledgesessionController@addSession')->middleware('auth', 'facilitator');
Route::get('/kennissessie/{id}','KnowledgesessionController@SessionUserView')->middleware('auth', 'employee');
Route::get('/sessiebeheer/{id}','KnowledgesessionController@SessionView')->middleware('auth', 'facilitator');
Route::post('/updatesession', 'KnowledgesessionController@updateSession')->middleware('auth','facilitator');
Route::get('/annuleer/kennissesie/{know_id}/gebruiker/{user_id}', 'KnowledgesessionController@anusession')->middleware('auth','facilitator');
Route::get('/signup/{id}','KnowledgesessionController@SignupSession')->middleware('auth', 'employee');
Route::get('/annuleer/{id}','KnowledgesessionController@CancelSession')->middleware('auth', 'employee');
Route::get('/delete/{id}', 'KnowledgesessionController@DeleteSession')->middleware('auth', 'facilitator');





