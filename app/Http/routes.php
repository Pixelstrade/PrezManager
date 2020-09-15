<?php

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


Route::get('/', 'HomeController@index');

Route::get('agenda','AgendaController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::resource('presentation', 'presentationController');


Route::resource('groupe', 'GroupeController');
Route::post('groupe/{id}/linkUser','GroupeController@linkUser');
Route::get('groupe/{id}/unlinkUser/{uid}','GroupeController@unlinkUser');
Route::get('groupe/{id}/delete','GroupeController@destroy');


Route::get('presentationtable','presentationController@tableView');
Route::post('presentation/{id}/updateZip','presentationController@updateZip');
Route::get('presentation/{id}/download','presentationController@downloadZip');
Route::post('presentation/{id}/linkUser','presentationController@linkUser');
Route::get('presentation/{id}/unlinkUser/{uid}','presentationController@unlinkUser');


Route::post('presentation/{id}/linkGroupe','presentationController@linkGroupe');
Route::get('presentation/{id}/unlinkGroupe/{uid}','presentationController@unlinkGroupe');

Route::get('presentation/{id}/delete','presentationController@destroy');


Route::get('personnel/{id}/delete','PersonnelController@destroy');

Route::get('presentation/{id}/views','presentationController@views');
//Route::get('presentation',['middleware' => 'auth', 'uses' => 'presentationController@index']);
Route::get('api','ApiController@index');
Route::get('api/presentation','ApiController@listPresentation');
Route::post('api/auth','ApiController@authenticate');
Route::get('api/auth','ApiController@authenticate');
Route::get('api/user','ApiController@getUser');
Route::get('api/presentation/{id}','ApiController@getFile');
Route::post('api/views','ApiController@addViews');
Route::post('api/delai','ApiController@addDelay');
Route::post('api/question','ApiController@addQuestions');

Route::resource('personnel', 'PersonnelController');