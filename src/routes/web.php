<?php
Route::name('bageur.')->group(function () {
	Route::group(['prefix' => 'bageur/v1','middleware' => 'bgr.verify'], function () {
		Route::apiResource('company', 'bageur\company\CompanyController');
		Route::apiResource('bank', 'bageur\company\BankController');
		Route::get('bank/resulttype','bageur\company\BankController@resultByType');
	});
});