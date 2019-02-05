<?php

Route::group(['prefix' => 'accedetercers'], function () {
	Route::get('/test/{filter}', 'Ajtarragona\AccedeTercers\Controllers\AccedeTestController@testHelper')->name('accede.test');

});