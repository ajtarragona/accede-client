<?php

Route::group(['prefix' => 'ajtarragona/accede','middleware' => ['web']	], function () {
	Route::get('/', 'Ajtarragona\Accede\Controllers\AccedeController@home')->name('accede.home');
	Route::get('/registre', 'Ajtarragona\Accede\Controllers\AccedeController@registerform')->name('accede.registerform');
	Route::post('/registre', 'Ajtarragona\Accede\Controllers\AccedeController@searchregister')->name('accede.searchregister');
	//Route::get('/test/{filter}', 'Ajtarragona\Accede\Controllers\AccedeTestController@test')->name('accede.test');
});


Route::group(['prefix' => 'ajtarragona/accede/api'], function () {
	
	//PAISOS
	Route::get('/paisos/search/{filter}', 'Ajtarragona\Accede\Controllers\AccedeController@paisos')->name('accede.paisos.search');
	Route::get('/paisos/{codigoPais}', 'Ajtarragona\Accede\Controllers\AccedeController@pais')->name('accede.pais');
	Route::get('/paisos', 'Ajtarragona\Accede\Controllers\AccedeController@paisos')->name('accede.paisos');

	//PROVINCIES
	Route::get('/provincies/search/{filter}', 'Ajtarragona\Accede\Controllers\AccedeController@provincies')->name('accede.provincies.search');
	Route::get('/provincies/{codigoProvincia}', 'Ajtarragona\Accede\Controllers\AccedeController@provincia')->name('accede.provincia');
	Route::get('/provincies', 'Ajtarragona\Accede\Controllers\AccedeController@provincies')->name('accede.provincies');
	

	//MUNICIPIS
	Route::get('/provincies/{codigoProvincia}/municipis/search/{filter}', 'Ajtarragona\Accede\Controllers\AccedeController@municipis')->name('accede.municipis.search');
	Route::get('/provincies/{codigoProvincia}/municipis', 'Ajtarragona\Accede\Controllers\AccedeController@municipis')->name('accede.municipis');
	Route::get('/provincies/{codigoProvincia}/municipis/{codigoMunicipio}', 'Ajtarragona\Accede\Controllers\AccedeController@municipi')->name('accede.municipi');


	//VIES
	Route::get('/provincies/{codigoProvincia}/municipis/{codigoMunicipio}/vies/search/{filter}', 'Ajtarragona\Accede\Controllers\AccedeController@vies')->name('accede.vies.search');
	
	Route::get('/provincies/{codigoProvincia}/municipis/{codigoMunicipio}/vies/combo', 'Ajtarragona\Accede\Controllers\AccedeController@viesCombo')->name('accede.vies.combo');

	Route::get('/provincies/{codigoProvincia}/municipis/{codigoMunicipio}/vies', 'Ajtarragona\Accede\Controllers\AccedeController@vies')->name('accede.vies');
	Route::get('/provincies/{codigoProvincia}/municipis/{codigoMunicipio}/vies/{codigoIneVia}', 'Ajtarragona\Accede\Controllers\AccedeController@via')->name('accede.via');


	//dades de la via
	Route::get('/numeros/combo/{codigoIneVia}', 'Ajtarragona\Accede\Controllers\AccedeController@numerosCombo')->name('accede.numeros.combo');
	Route::get('/numeros/{codigoIneVia}', 'Ajtarragona\Accede\Controllers\AccedeController@numeros')->name('accede.numeros');

	Route::get('/escales/combo/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeController@escalesCombo')->name('accede.escales.combo');
	Route::get('/escales/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeController@escales')->name('accede.escales');


	Route::get('/lletres/combo/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeController@lletresCombo')->name('accede.lletres.combo');
	Route::get('/lletres/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeController@lletres')->name('accede.lletres');

	Route::get('/blocs/combo/{codigoIneVia}', 'Ajtarragona\Accede\Controllers\AccedeController@blocsCombo')->name('accede.blocs.combo');
	Route::get('/blocs/{codigoIneVia}', 'Ajtarragona\Accede\Controllers\AccedeController@blocs')->name('accede.blocs');

	Route::get('/plantes/combo/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeController@plantesCombo')->name('accede.plantes.combo');
	Route::get('/plantes/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeController@plantes')->name('accede.plantes');

	Route::get('/portes/combo/{codigoIneVia}/{numero?}/{nombrePlanta?}', 'Ajtarragona\Accede\Controllers\AccedeController@portesCombo')->name('accede.portes.combo');
	Route::get('/portes/{codigoIneVia}/{numero?}/{nombrePlanta?}', 'Ajtarragona\Accede\Controllers\AccedeController@portes')->name('accede.portes');
	
	Route::get('/codispostals/combo/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeController@codispostalsCombo')->name('accede.codispostals.combo');
	Route::get('/codispostals/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeController@codispostals')->name('accede.codispostals');
	

});