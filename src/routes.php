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
	Route::post('/tercer/{codigoTercero}', 'Ajtarragona\Accede\Controllers\AccedeTercersController@save')->name('accede.tercer.save');
	Route::post('/tercer', 'Ajtarragona\Accede\Controllers\AccedeTercersController@store')->name('accede.tercer.store');
	
	Route::get('/tercer/{codigoTercero}/domicilis/add', 'Ajtarragona\Accede\Controllers\AccedeTercersController@newdomicili')->name('accede.tercer.domicilis.addmodal');

	Route::post('/tercer/{codigoTercero}/domicilis/add', 'Ajtarragona\Accede\Controllers\AccedeTercersController@storedomicili')->name('accede.tercer.domicilis.store');

	Route::post('/tercer/{codigoTercero}/domicilis/search', 'Ajtarragona\Accede\Controllers\AccedeTercersController@searchdomicilis')->name('accede.tercer.domicilis.dosearch');

	Route::post('/tercer/{codigoTercero}/domicilis/assign', 'Ajtarragona\Accede\Controllers\AccedeTercersController@assigndomicilis')->name('accede.tercer.domicilis.assign');

	Route::post('/tercer/{codigoTercero}/domicilis/{codigoDomicilio}', 'Ajtarragona\Accede\Controllers\AccedeTercersController@updatedomicili')->name('accede.tercer.domicilis.update');

	
	//Route::get('/test/{filter}', 'Ajtarragona\Accede\Controllers\AccedeTestController@test')->name('accede.test');
});


Route::group(['prefix' => 'ajtarragona/accede/api'], function () {
	
	//TERCERS

	Route::get('/tercers/search/{filter}', 'Ajtarragona\Accede\Controllers\AccedeTercersApiController@tercers')->name('accede.tercers.search');
	Route::get('/tercers/combo', 'Ajtarragona\Accede\Controllers\AccedeTercersApiController@tercersCombo')->name('accede.tercers.combo');

	//PAISOS
	Route::get('/paisos/search/{filter}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@paisos')->name('accede.paisos.search');
	Route::get('/paisos/{codigoPais}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@pais')->name('accede.pais');
	Route::get('/paisos', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@paisos')->name('accede.paisos');

	//PROVINCIES
	Route::get('/provincies/search/{filter}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@provincies')->name('accede.provincies.search');
	Route::get('/provincies/{codigoProvincia}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@provincia')->name('accede.provincia');
	Route::get('/provincies', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@provincies')->name('accede.provincies');
	

	//MUNICIPIS
	Route::get('/provincies/{codigoProvincia}/municipis/search/{filter}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@municipis')->name('accede.municipis.search');
	Route::get('/provincies/{codigoProvincia}/municipis', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@municipis')->name('accede.municipis');
	Route::get('/provincies/{codigoProvincia}/municipis/{codigoMunicipio}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@municipi')->name('accede.municipi');


	//VIES
	Route::get('/provincies/{codigoProvincia}/municipis/{codigoMunicipio}/vies/search/{filter}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@vies')->name('accede.vies.search');
	
	Route::get('/provincies/{codigoProvincia}/municipis/{codigoMunicipio}/vies/combo', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@viesCombo')->name('accede.vies.combo');

	Route::get('/provincies/{codigoProvincia}/municipis/{codigoMunicipio}/vies', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@vies')->name('accede.vies');
	Route::get('/provincies/{codigoProvincia}/municipis/{codigoMunicipio}/vies/{codigoIneVia}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@via')->name('accede.via');

	
	//dades de la via
	Route::get('/codificadors/{codigoIneVia}/{numero?}/{nombrePlanta?}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@codificadors')->name('accede.codificadors');
	
	//tipus de via
	Route::get('/tipusvia/combo/{codigoIneVia?}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@tipusviaCombo')->name('accede.tipusvia.combo');
	Route::get('/tipusvia/{codigoIneVia?}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@tipusvia')->name('accede.tipusvia');

	
	//numeros
	Route::get('/numeros/combo/{codigoIneVia}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@numerosCombo')->name('accede.numeros.combo');
	Route::get('/numeros/{codigoIneVia}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@numeros')->name('accede.numeros');

	//blocs
	Route::get('/blocs/combo/{codigoIneVia}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@blocsCombo')->name('accede.blocs.combo');
	Route::get('/blocs/{codigoIneVia}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@blocs')->name('accede.blocs');
	Route::get('/blocs', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@allBlocs')->name('accede.allblocs');


	//escales
	Route::get('/escales/combo/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@escalesCombo')->name('accede.escales.combo');
	Route::get('/escales/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@escales')->name('accede.escales');
	Route::get('/escales', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@allEscales')->name('accede.allescales');


	//lletres
	Route::get('/lletres/combo/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@lletresCombo')->name('accede.lletres.combo');
	Route::get('/lletres/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@lletres')->name('accede.lletres');

	//plantes
	Route::get('/plantes/combo/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@plantesCombo')->name('accede.plantes.combo');
	Route::get('/plantes/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@plantes')->name('accede.plantes');
	Route::get('/plantes', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@allPlantes')->name('accede.allplantes');

	
	//codis postals
	Route::get('/codispostals/combo/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@codispostalsCombo')->name('accede.codispostals.combo');
	Route::get('/codispostals/{codigoIneVia}/{numero?}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@codispostals')->name('accede.codispostals');
	Route::get('/codispostals', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@allCodispostals')->name('accede.allcodispostals');
	
	//portes
	Route::get('/portes/combo/{codigoIneVia}/{numero?}/{nombrePlanta?}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@portesCombo')->name('accede.portes.combo');
	Route::get('/portes/{codigoIneVia}/{numero?}/{nombrePlanta?}', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@portes')->name('accede.portes');
	Route::get('/portes', 'Ajtarragona\Accede\Controllers\AccedeVialerApiController@allPortes')->name('accede.allportes');
	




});