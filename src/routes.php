<?php

Route::group(['prefix' => 'accede'], function () {
	Route::get('/test/{filter}', 'Ajtarragona\Accede\Controllers\AccedeTestController@test')->name('accede.test');

});