<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//General
Route::post('/loggingin', 'MainController@checklogin');
Route::post('/register', 'MainController@register');
Route::get('/logout', 'MainController@logout')->middleware('auth', 'employee');
Route::get('/', [ 'as' => 'login', 'uses' => 'MainController@LoginView']);

Route::get('/verify','MainController@verifyAccount');

//Admin
Route::get('/gebruikers','EmployeeController@EmployeeView')->middleware('auth', 'admin');
Route::get('/gebruiker/{id}', 'EmployeeController@EmployeeDetails')->middleware('auth', 'admin');
Route::post('/updategebruiker', 'EmployeeController@UpdateEmployee')->middleware('auth', 'admin');

//employee
Route::get('/dashboard', 'MainController@DashboardView')->middleware('auth', 'employee');
Route::get('/profiel', 'ProfileController@ProfileView')->middleware('auth', 'employee');
Route::post('/updatedata', 'ProfileController@UpdateUserData')->middleware('auth', 'employee');

//Knowledgesessions facilitator
Route::get('/kennissessies/beheer', 'KnowledgesessionController@KnowledgesessionBeheer')->middleware('auth', 'facilitator');
Route::get('/kennissessies/toevoegen', 'KnowledgesessionController@addView')->middleware('auth', 'facilitator');
Route::post('/addingsession', 'KnowledgesessionController@addSession')->middleware('auth', 'facilitator');
Route::get('/sessiebeheer/{id}','KnowledgesessionController@SessionView')->middleware('auth', 'facilitator');
Route::post('/updatesession', 'KnowledgesessionController@updateSession')->middleware('auth','facilitator');
Route::get('/annuleer/kennissesie/{know_id}/gebruiker/{user_id}', 'KnowledgesessionController@anusession')->middleware('auth','facilitator');
Route::get('/verwijder/kennissesie/{know_id}/gebruiker/{user_id}', 'KnowledgesessionController@removeAttendee')->middleware('auth','facilitator');
Route::get('/addattendee/kennissesie/{know_id}/gebruiker/{id}', 'KnowledgesessionController@addAttendee')->middleware('auth','facilitator');
Route::get('/delete/{id}', 'KnowledgesessionController@DeleteSession')->middleware('auth', 'facilitator');
Route::get('/attend/user/{ses_id}', 'KnowledgesessionController@attendUser')->middleware('auth', 'facilitator');


//Knowledgesessions employee
Route::get('/kennissessies', 'KnowledgesessionController@KnowledgesessionView')->middleware('auth', 'employee');
Route::get('/kennissessie/{id}','KnowledgesessionController@SessionUserView')->middleware('auth', 'employee');
Route::get('/signup/{id}','KnowledgesessionController@SignupSession')->middleware('auth', 'employee');
Route::get('/annuleer/{id}','KnowledgesessionController@CancelSession')->middleware('auth', 'employee');
Route::post('/evalueer', 'KnowledgesessionController@EvaluateSession')->middleware('auth', 'employee');

//Knowledgesessions review
Route::get('/evaluaties','KnowledgesessionController@evaluateView')->middleware('auth', 'facilitator');
Route::get('/evalueer/{id}', 'KnowledgesessionController@evaluateSessionView')->middleware('auth', 'employee');








