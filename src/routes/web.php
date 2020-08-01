<?php
Route::name('bageur.')->group(function () {
	Route::group(['prefix' => 'bageur/v1','middleware' => 'jwt.verify'], function () {
		Route::apiResource('company', 'bageur\company\CompanyController');
	});
});