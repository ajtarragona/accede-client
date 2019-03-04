<?php

namespace Ajtarragona\Accede\Models; 

use Ajtarragona\Accede\Models\AccedeProvider;
use Ajtarragona\Accede\Models\AccedeObject;

use Ajtarragona\Accede\Models\Beans\Anotacion;


class AccedeRegistreProvider extends AccedeProvider{
	
	
	
	public function getAnotacionPorDni($eje, $documento){
		$params=[
			"eje" => intval($eje),
			"efecto_registral" => 1,
			"interesado" => [
				"documento"=> $documento
			]
		];
		//dd($params);
		$response=$this->sendRequest("REG","LST",$params,["apl"=>"REG","excluded"=>["documento"]]);
		//dd($response);
		$ret=Anotacion::parseResponse($response);
		//dd($ret);
		return $ret;
	}

	public function getAnotacion($es, $eje, $numero){
		$params=[
			"eje" => intval($eje),
			"tip" => $es,
			"l_numero" => [
				"numero" => [
					"general"=> intval($numero)
				]
			]
		];

		//dd($params);
		$response=$this->sendRequest("REG","LST",$params,["apl"=>"REG"]);
		
		//dd($response);
		return Anotacion::parseResponse($response);
	} 
}
