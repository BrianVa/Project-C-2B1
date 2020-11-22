<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



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

//Admin
Route::get('/gebruikers','EmployeeController@EmployeeView');
Route::get('/gebruiker/{id}', 'EmployeeController@EmployeeDetails');
Route::post('/updategebruiker', 'EmployeeController@UpdateEmployee');

//Medewerker
Route::get('/dashboard', 'MainController@DashboardView');

//General
Route::post('/loggingin', 'MainController@checklogin');
Route::post('/register', 'MainController@register');
Route::get('/logout', 'MainController@logout');
Route::get('/', 'MainController@LoginView');
Route::get('/profiel', 'ProfileController@ProfileView');
Route::post('/updatedata', 'ProfileController@UpdateUserData');


//Knowledge sessions
Route::get('/kennissessies', 'KnowledgesessionController@KnowledgesessionView');
Route::get('/kennissessies/toevoegen', 'KnowledgesessionController@addView');
Route::post('/addingsession', 'KnowledgesessionController@addSession');
Route::get('/kennissessie/{id}','KnowledgesessionController@SessionUserView');
Route::get('/sessiebeheer/{id}','KnowledgesessionController@SessionView');
Route::post('/updatesession', 'KnowledgesessionController@updateSession');
Route::get('/signup/{id}','KnowledgesessionController@SignupSession');
Route::get('/annuleer/{id}','KnowledgesessionController@CancelSession');






