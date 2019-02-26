<?php

Route::group(['prefix' => 'ajtarragona/accede','middleware' => ['web']	], function () {
	Route::get('/', 'Ajtarragona\Accede\Controllers\AccedeVialerController@home')->name('accede.home');
	//Route::get('/domicili/new', 'Ajtarragona\Accede\Controllers\AccedeVialerController@create')->name('accede.domicili.create');
	
	Route::get('/domicili/newmodal', 'Ajtarragona\Accede\Controllers\AccedeVialerController@newmodal')->name('accede.domicili.create.modal');
	Route::get('/domicili', 'Ajtarragona\Accede\Controllers\AccedeVialerController@search')->name('accede.domicili.search');
	Route::post('/domicili/search', 'Ajtarragona\Accede\Controllers\AccedeVialerController@dosearch')->name('accede.domicili.dosearch');
	Route::get('/domicili/{codigoDomicilio}', 'Ajtarragona\Accede\Controllers\AccedeVialerController@show')->name('accede.domicili.show');
	Route::post('/domicili', 'Ajtarragona\Accede\Controllers\AccedeVialerController@store')->name('accede.domicili.store');


	Route::get('/registre', 'Ajtarragona\Accede\Controllers\AccedeRegistreController@search')->name('accede.register.search');
	Route::post('/registre', 'Ajtarragona\Accede\Controllers\AccedeRegistreController@dosearch')->name('accede.register.dosearch');



	Route::get('/tercer/newmodal', 'Ajtarragona\Accede\Controllers\AccedeTercersController@newmodal')->name('accede.tercer.create.modal');
	Route::get('/tercer', 'Ajtarragona\Accede\Controllers\AccedeTercersController@search')->name('accede.tercer.search');
	Route::post('/tercer/search', 'Ajtarragona\Accede\Controllers\AccedeTercersController@dosearch')->name('accede.tercer.dosearch');
	Route::get('/tercer/{codigoTercero}', 'Ajtarragona\Accede\Controllers\AccedeTercersController@show')->name('accede.tercer.show');
	Route::post('/tercer', 'Ajtarragona\Accede\Controllers\AccedeTercersController@store')->name('accede.tercer.store');

	
	//Route::get('/test/{filter}', 'Ajtarragona\Accede\Controllers\AccedeTestController@test')->name('accede.test');
});


Route::group(['prefix' => 'ajtarragona/accede/api'], function () {
	
	//PAISOS
	Route::get('/paisos/search/{filter}', 'Ajtarragona\Accede\Controllers\AccedeApiController@paisos')->name('accede.paisos.search');
	Route::get('/paisos/{codigoPais}', 'Ajtarragona\Accede\Controllers\AccedeApiController@pais')->name('accede.pais');
	Route::get('/paisos', 'Ajtarragona\Accede\Controllers\AccedeApiController@paisos')->name('accede.paisos');

	//PROVINCIES
	Route::get('/provincies/search/{filter}', 'Ajtarragona\Accede\Controllers\AccedeApiController@provincies')->name('accede.provincies.search');
	Route::get('/provincies/{codigoProvincia}', 'Ajtarragona\Accede\Controllers\AccedeApiController@provincia')->name('accede.provincia');
	Route::get('/provincies', 'Ajtarragona\Accede\Controllers\AccedeApiController@provincies')->name('accede.provincies');
	

	//MUNICIPIS
	Route::get('/provincies/{codigoProvincia}/municipis/search/{filter}', 'Ajtarragona\Accede\Controllers\AccedeApiController@municipis')->name('accede.municipis.search');
	Route::get('/provincies/{codigoProvincia}/municipis', 'Ajtarragona\Accede\Controllers\AccedeApiController@municipis')->name('accede.municipis');
	Route::get('/provincies/{codigoProvincia}/municipis/{codigoMunicipio}', 'Ajtarragona\Accede\Controllers\AccedeApiController@municipi')->name('accede.municipi');


	//VIES
	Route::get('/provincies/{codigoProvincia}/municipis/{codigoMunicipio}/vies/search/{filter}', 'Ajtarragona\Accede\Controllers\AccedeApiController@vies')->name('accede.vies.search');
	
	Route::get('/provincies/{codigoProvincia}/municipis/{codigoMunicipio}/vies/combo', 'Ajtarragona\Accede\Controllers\AccedeApiController@viesCombo')->name('accede.vies.combo');

	Route::get('/provincies/{codigoProvincia}/municipis/{codigoMunicipio}/vies', 'Ajtarragona\Accede\Controllers\AccedeApiController@vies')->name('accede.vies');
	Route::get('/provincies/{codigoProvincia}/municipis/{codigoMunicipio}/vies/{codigoIneVia}', 'Ajtarragona\Accede\Controllers\AccedeApiController@via')->name('accede.via');

	
	//dades de la via
	Route::get('/codificadors/{codigoIneVia}/{numero?}/{nombrePlanta?}', 'Ajtarragona\Accede\Controllers\AccedeApiController@codificadors')->name('accede.codificadors');
	
	//tipus de via
	Route::get('/tipusvia/combo/{codigoIneVia?}', 'Ajtarragona\Accede\Controllers\AccedeApiController@tipusviaCombo')->name('accede.tipusvia.combo');
	Route::get('/tipusvia/{codigoIneVia?}', 'Ajtarragona\Accede\Controllers\AccedeApiController@tipusvia')->name('accede.tipusvia');

	
	//numeros
	Route::get('/numeros/combo/{codigoIneVia}', 'Ajtarragona\Accede\Controllers\AccedeApiController@numerosCombo')->name('accede.numeros.combo');
	Route::get('/numeros/{codigoIneVia}', 'Ajtarragona\Accede\Controllers\AccedeApiController@numeros')->name('accede.numeros');

	//blocs
	Route::get('/blocs/combo/{codigoIneVia}', 'Ajtarragona\Accede\Controllers\AccedeApiController@blocsCombo')->name('accede.blocs.combo');
	Route::get('/blocs/{codigoIneVia}', 'Ajtarragona\Accede\Controllers\AccedeApiController@blocs')->name('accede.blocs');
	Route::get('/blocs', 'Ajtarragona\Accede\Controllers\AccedeApiController@allBlocs')->name('accede.allblocs');


	//escales
	Route::get('/escales/combo/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeApiController@escalesCombo')->name('accede.escales.combo');
	Route::get('/escales/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeApiController@escales')->name('accede.escales');
	Route::get('/escales', 'Ajtarragona\Accede\Controllers\AccedeApiController@allEscales')->name('accede.allescales');


	//lletres
	Route::get('/lletres/combo/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeApiController@lletresCombo')->name('accede.lletres.combo');
	Route::get('/lletres/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeApiController@lletres')->name('accede.lletres');

	//plantes
	Route::get('/plantes/combo/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeApiController@plantesCombo')->name('accede.plantes.combo');
	Route::get('/plantes/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeApiController@plantes')->name('accede.plantes');
	Route::get('/plantes', 'Ajtarragona\Accede\Controllers\AccedeApiController@allPlantes')->name('accede.allplantes');

	
	//codis postals
	Route::get('/codispostals/combo/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeApiController@codispostalsCombo')->name('accede.codispostals.combo');
	Route::get('/codispostals/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeApiController@codispostals')->name('accede.codispostals');
	Route::get('/codispostals', 'Ajtarragona\Accede\Controllers\AccedeApiController@allCodispostals')->name('accede.allcodispostals');
	
	//portes
	Route::get('/portes/combo/{codigoIneVia}/{numero?}/{nombrePlanta?}', 'Ajtarragona\Accede\Controllers\AccedeApiController@portesCombo')->name('accede.portes.combo');
	Route::get('/portes/{codigoIneVia}/{numero?}/{nombrePlanta?}', 'Ajtarragona\Accede\Controllers\AccedeApiController@portes')->name('accede.portes');
	Route::get('/portes', 'Ajtarragona\Accede\Controllers\AccedeApiController@allPortes')->name('accede.allportes');
	

});