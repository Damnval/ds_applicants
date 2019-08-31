<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1'], function() {
	// get all applicants route
	Route::get('/applicants', 'API\ApplicantController@index');
	// delete an applicant route
	Route::delete('/applicant/{id}', 'API\ApplicantController@destroy');
	// edit an applicant route
	Route::get('/applicant/{id}/edit', 'API\ApplicantController@edit');
	// update an applicant route
	Route::put('/applicant/{id}', 'API\ApplicantController@update');
	// create page for applicant route
	Route::get('/applicant/create', 'API\ApplicantController@create');
	// storing applicant route
	Route::post('/applicant', 'API\ApplicantController@store');
	// generates dummy applicants
	Route::get('/dummy-applicants', 'API\ApplicantController@generateDummyApplicant');
});
