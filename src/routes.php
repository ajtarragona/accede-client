<?php

Route::group(['prefix' => 'accedetercers'], function () {
	Route::get('/test/{filter}', 'Ajtarragona\Accede\Controllers\AccedeTestController@testHelper')->name('accede.test');

});