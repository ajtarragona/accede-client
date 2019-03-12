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
			"estado_anotacion" => "-3,-2,-1,0,1,2,3",
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
		//dump($numero);

		$numeros = [];
		if(!is_array($numero)){
			if(str_contains($numero,"-")){
				$range=explode("-",$numero);
				$numeros=range($range[0],$range[1]);
			}else if(str_contains($numero,",")){
				$numeros=explode(",",$numero);
			}else{
				$numeros=[$numero];
			}
		}else{
			$numeros=$numero;
		}
		$lnumero=[];
		foreach($numeros as $num){
			$lnumero[]=[
				"general" => intval($num)
			];
		}


		$params=[
			"eje" => intval($eje),
			"efecto_registral" => 1,
			"tip" => $es,
			"estado_anotacion" => "-3,-2,-1,0,1,2,3",
			"l_numero" => $lnumero
		];

		//dd($params);
		$response=$this->sendRequest("REG","LST",$params,["apl"=>"REG"]);
		
		//dd($response);
		return Anotacion::parseResponse($response);
	} 
}
