<?php

namespace Ajtarragona\Accede\Models; 

use Ajtarragona\Accede\Models\AccedeProvider;
use Ajtarragona\Accede\Models\AccedeObject;

use Ajtarragona\Accede\Models\Beans\Via;
use Ajtarragona\Accede\Models\Beans\Pais;
use Ajtarragona\Accede\Models\Beans\TipusVia;
use Ajtarragona\Accede\Models\Beans\Bloc;
use Ajtarragona\Accede\Models\Beans\CodiPostal;
use Ajtarragona\Accede\Models\Beans\Provincia;
use Ajtarragona\Accede\Models\Beans\Municipi;
use Ajtarragona\Accede\Models\Beans\Portal;
use Ajtarragona\Accede\Models\Beans\Porta;
use Ajtarragona\Accede\Models\Beans\Planta;
use Ajtarragona\Accede\Models\Beans\Escala;
use Ajtarragona\Accede\Models\Beans\Domicili;
use Ajtarragona\Accede\Exceptions\AccedeNoResultsException;

class AccedeVialerProvider extends AccedeProvider{
	




	/***********/
	/*paisos*/
	/***********/

	public function getPais($codigoPais) {	
		$params=array(
			"codigoPais" => $codigoPais,
		);

		$response=$this->sendRequest("PAI","LST",$params);
		return Pais::parseSingle($response);
	}



	public function getAllPaisos() {	
		$params=array(
			//"codigoPais" => 108,
			//"nombrePais" => "%fra",
		);


		$response=$this->sendRequest("PAI","LST",$params);
		return Pais::parseResponse($response);
	}


	//TODO: no se  puede buscar por parte del nombre!! ??
	public function searchPaisosByName($filter) {	
		
		$params=array(
			"nombrePais" => strtoupper($filter),
		);

		$response=$this->sendRequest("PAI","LST",$params);
		return Pais::parseResponse($response);
	}






	/***********/
	/*provincies*/
	/***********/

	public function getProvincia($codigoProvincia) {	
		$params=array(
			"codigoProvincia" => $codigoProvincia,
		);

		$response=$this->sendRequest("PRV","LST",$params);
		return Provincia::parseSingle($response);
	}



	public function getAllProvincies() {	
		$params=array(
			//"codigoAutonomia" => 9,
			//"nombrePais" => "%fra",
		);


		$response=$this->sendRequest("PRV","LST",$params);
		return Provincia::parseResponse($response);
	}


	//TODO: no se  puede buscar por parte del nombre!! ??
	public function searchProvinciesByName($filter) {	
		
		$params=array(
			"nombreProvincia" => strtoupper($filter),
		);

		$response=$this->sendRequest("PRV","LST",$params);
		return Provincia::parseResponse($response);
	}







	/***********/
	/*municipis*/
	/***********/

	public function getMunicipi($codigoMunicipio,$codigoProvincia=false) {	
		if(!$codigoProvincia) $codigoProvincia=$this->options->codigo_provincia_tarragona;
		
		$params=array(
			"codigoProvincia" => $codigoProvincia,
			"codigoMunicipio" => $codigoMunicipio,
		);

		$response=$this->sendRequest("MUN","LST",$params);
		return Municipi::parseSingle($response);
	}



	public function getAllMunicipis($codigoProvincia=false) {	
		if(!$codigoProvincia) $codigoProvincia=$this->options->codigo_provincia_tarragona;
		
		$params=array(
			"codigoProvincia" => $codigoProvincia,
		);


		$response=$this->sendRequest("MUN","LST",$params);
		return Municipi::parseResponse($response);
	}


	//TODO: no se  puede buscar por parte del nombre!! ??
	public function searchMunicipisByName($filter,$codigoProvincia=false) {	
		if(!$codigoProvincia) $codigoProvincia=$this->options->codigo_provincia_tarragona;
		
		$params=array(
			"codigoProvincia" => $codigoProvincia,
			"nombreMunicipio" => strtoupper($filter),
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,

		);

		$response=$this->sendRequest("MUN","LST",$params);
		return Municipi::parseResponse($response);
	}





	/***********/
	/*portal*/
	/***********/
	
	public function getPortal($codigoPortal) {	
		$params=array(
			"codigoPortal" => $codigoPortal,
		);

		$response=$this->sendRequest("POR","LST",$params);
		return Portal::parseSingle($response);
	}



	//TODO: no devuelve nada
	public function getAllPortals( ) {	
		
		$params=array();

		$response=$this->sendRequest("POR","LST",$params);
		return Portal::parseResponse($response);
	}




	/***********/
	/*porta*/
	/***********/
	
	public function getPorta($codigoPuerta) {	
		$params=array(
			"codigoPuerta" => $codigoPuerta,
		);

		$response=$this->sendRequest("PTA","LST",$params);
		return Porta::parseSingle($response);
	}



	public function getAllPortes( ) {	
		
		$params=array();

		$response=$this->sendRequest("PTA","LST",$params);
		return Porta::parseResponse($response);
	}



	/***********/
	/*planta*/
	/***********/
	
	public function getPlanta($codigoPlanta) {	
		$params=array(
			"codigoPlanta" => $codigoPlanta,
		);

		$response=$this->sendRequest("PLT","LST",$params);
		return Planta::parseSingle($response);
	}



	public function getAllPlantes( ) {	
		
		$params=array();

		$response=$this->sendRequest("PLT","LST",$params);
		return Planta::parseResponse($response);
	}



	/***********/
	/*escales*/
	/***********/
	
	public function getEscala($codigoEscalera) {	
		$params=array(
			"codigoEscalera" => $codigoEscalera,
		);

		$response=$this->sendRequest("ESC","LST",$params);
		return Escala::parseSingle($response);
	}



	public function getAllEscales( ) {	
		
		$params=array();

		$response=$this->sendRequest("ESC","LST",$params);
		return Escala::parseResponse($response);
	}







	/***********/
	/*bloques*/
	/***********/

	public function getAllBlocs($codiProvincia=false, $codiMunicipi=false) {	
		if(!$codiProvincia) $codiProvincia=$this->options->codigo_provincia_tarragona;
		if(!$codiMunicipi) $codiMunicipi=$this->options->codigo_municipio_tarragona;
		
		$params=array(
			 "codigoProvincia" => $codiProvincia,
			 "codigoMunicipio" => $codiMunicipi
		);


		$response=$this->sendRequest("BLQ","LST",$params);
		return Bloc::parseResponse($response);
	}


	public function getBloc($codigoBloque){
		
		$params=array(
			"codigoBloque" => $codigoBloque
		);

		$response=$this->sendRequest("BLQ","LST",$params);
		return Bloc::parseSingle($response);
	}







	/***********/	
	/*codis postals*/
	/***********/	


	public function getAllCodisPostals($codiProvincia=false, $codiMunicipi=false) {	
		if(!$codiProvincia && !$codiMunicipi ){
			$codiProvincia=$this->options->codigo_provincia_tarragona;
			$codiMunicipi=$this->options->codigo_municipio_tarragona;
		}
		
		$params=array();

		if($codiProvincia) $params["codigoProvincia"] = $codiProvincia;
		if($codiMunicipi) $params["codigoMunicipio"] = $codiMunicipi;

		$response=$this->sendRequest("CPO","LST",$params);
		return CodiPostal::parseResponse($response);
	}


	public function getCodiPostal($codigoPostal, $codiProvincia=false, $codiMunicipi=false){
		if(!$codiProvincia && !$codiMunicipi ){
			$codiProvincia=$this->options->codigo_provincia_tarragona;
			$codiMunicipi=$this->options->codigo_municipio_tarragona;
		}
		
		$params=array();

		if($codiProvincia) $params["codigoProvincia"] = $codiProvincia;
		if($codiMunicipi) $params["codigoMunicipio"] = $codiMunicipi;

		$params["codigoPostal"] = $codigoPostal;

		$response=$this->sendRequest("CPO","LST",$params);
		return CodiPostal::parseSingle($response);
	}

	



	/***********/
	/*vies*/
	/***********/	
	public function searchViesByName($filter, $codiProvincia=false, $codiMunicipi=false ) {	
		if(!$codiProvincia) $codiProvincia=$this->options->codigo_provincia_tarragona;
		if(!$codiMunicipi) $codiMunicipi=$this->options->codigo_municipio_tarragona;
		
		$params=array(
			"nombreVia" => strtoupper("*".$filter."*"),
			"codigoProvincia" => $codiProvincia,
			"codigoMunicipio" => $codiMunicipi
		);

		$response=$this->sendRequest("VIA","LST",$params);
		return Via::parseResponse($response);
	}

	
	public function getVia($codigoIneVia, $codiProvincia=false, $codiMunicipi=false) {	
		if(!$codiProvincia) $codiProvincia=$this->options->codigo_provincia_tarragona;
		if(!$codiMunicipi) $codiMunicipi=$this->options->codigo_municipio_tarragona;
		
		$params=array(
			"codigoIneVia" => $codigoIneVia,
			"codigoProvincia" => $codiProvincia,
			"codigoMunicipio" => $codiMunicipi
		);

		$response=$this->sendRequest("VIA","LST",$params);
		return Via::parseSingle($response);
	}


	public function getAllVies($codiProvincia=false, $codiMunicipi=false ) {	
		if(!$codiProvincia) $codiProvincia=$this->options->codigo_provincia_tarragona;
		if(!$codiMunicipi) $codiMunicipi=$this->options->codigo_municipio_tarragona;
		
		$params=array(
			"codigoProvincia" => $codiProvincia,
			"codigoMunicipio" => $codiMunicipi
		);

		$response=$this->sendRequest("VIA","LST",$params);
		return Via::parseResponse($response);
	}




	





	/***********/
	/*tipus de via*/
	/***********/	

	public function getAllTipusVia($codiProvincia=false, $codiMunicipi=false ) {	
		//if(!$codiProvincia) $codiProvincia=$this->options->codigo_provincia_tarragona;
		//if(!$codiMunicipi) $codiMunicipi=$this->options->codigo_municipio_tarragona;
		
		$params=array(
			//"codigoProvincia" => $codiProvincia,
			//"codigoMunicipio" => $codiMunicipi
		);


		$response=$this->sendRequest("TVI","LST",$params);
		return TipusVia::parseResponse($response);
	}


	public function getTipusVia($codigoTipoVia){
		
		$params=array(
			"codigoTipoVia" => $codigoTipoVia
		);

		$response=$this->sendRequest("TVI","LST",$params);
		return TipusVia::parseSingle($response);
	}









	/***********/
	/*domicilis*/
	/***********/


	//TODO: peta por todas partes
	public function searchDomicilis($params=[]) {
		if(isset($params["numero"])){
			$params["numeroDesde"]= $params["numero"];
			$params["numeroHasta"]= $params["numero"];
			unset($params["numero"]);
		}
		if(isset($params["nombreVia"])) $params["nombreVia"]=strtoupper($params["nombreVia"]);
		$response=$this->sendRequest("DOM","LST",$params);
		return Domicili::parseResponse($response);
	}

	public function getDomicilisByVia($codiVia,$numeroDesde=false,$numeroHasta=false) {	
		$params=array(
			"codigoVia" => $codiVia
		);
		if($numeroDesde){
			$params["numeroDesde"]= $numeroDesde;
			$params["numeroHasta"]= $numeroHasta?$numeroHasta:$numeroDesde;
		}
		return $this->searchDomicilis($params);
	
	}


	


	public function getCodisPostalsVia($codigoIneVia, $numero=false){
		//$via=self::getVia($codigoIneVia);
		$args=["codigoIneVia"=>intval($codigoIneVia)];
		if(!isFalse($numero)) $args["numero"] =intval($numero);
		$domicilis=self::searchDomicilis($args);
		$ret=[];
		foreach($domicilis as $domicili){
			if(!in_array($domicili->codigoPostal, $ret)) $ret[]=$domicili->codigoPostal;
		}
		sort($ret);
		return $ret;
	}


	public function getNumerosVia($codigoIneVia){
		//$via=self::getVia($codigoIneVia);
		$args=["codigoIneVia"=>intval($codigoIneVia)];
		$domicilis=self::searchDomicilis($args);
		$ret=[];
		foreach($domicilis as $domicili){
			if($domicili->numeroDesde && !in_array($domicili->numeroDesde, $ret)) $ret[]=$domicili->numeroDesde;
		}
		sort($ret);
		return $ret;
	}


	public function getLletresVia($codigoIneVia, $numero=false){
		//$via=self::getVia($codigoIneVia);
		$args=["codigoIneVia"=>intval($codigoIneVia)];
		if(!isFalse($numero)) $args["numero"] =intval($numero);
		
		$domicilis=self::searchDomicilis($args);
		$ret=[];
		foreach($domicilis as $domicili){
			if(isset($domicili->letraDesde) && $domicili->letraDesde && !in_array($domicili->letraDesde, $ret)) $ret[]=$domicili->letraDesde;
		}
		sort($ret);
		return $ret;
	}
	

	public function getPlantesVia($codigoIneVia, $numero=false){
		//$via=self::getVia($codigoIneVia);
		//dd($codigoIneVia);
		$args=[
			"codigoIneVia"=>intval($codigoIneVia)
		];
		if(!isFalse($numero)) $args["numero"] =intval($numero);
		
		$domicilis=self::searchDomicilis($args);

		$ret=[];
		foreach($domicilis as $domicili){
			if(isset($domicili->codigoPlanta) &&  $domicili->codigoPlanta && !isset($ret[$domicili->codigoPlanta]) ){
				$ret[$domicili->codigoPlanta]=[
					"codigoPlanta"=>$domicili->codigoPlanta,
					"nombrePlanta"=>$domicili->nombrePlanta
				];
			}
		}
		sort($ret);
		return $ret;
	}


	public function getEscalesVia($codigoIneVia, $numero=false){
		//$via=self::getVia($codigoIneVia);
		$args=[
			"codigoIneVia"=>intval($codigoIneVia)
		];
		if(!isFalse($numero)) $args["numero"] =intval($numero);

		$domicilis=self::searchDomicilis($args);

		$ret=[];
		foreach($domicilis as $domicili){
			if(isset($domicili->codigoEscalera) && $domicili->codigoEscalera && !isset($ret[$domicili->codigoEscalera])){
				$ret[$domicili->codigoEscalera]=[
					"codigoEscalera"=> $domicili->codigoEscalera,
					"nombreEscalera"=> $domicili->nombreEscalera
				];
			}
		}
		if(!$ret) throw new AccedeNoResultsException('No results');
		
		sort($ret);
		return $ret;
	}


	public function getBlocsVia($codigoIneVia){
		//$via=self::getVia($codigoIneVia);
		$args=[
			"codigoIneVia"=>intval($codigoIneVia)
		];
		//if($numero) $args["numero"] =intval($numero);

		$domicilis=self::searchDomicilis($args);

		$ret=[];
		foreach($domicilis as $domicili){
			if(isset($domicili->codigoBloque) && $domicili->codigoBloque && !isset($ret[$domicili->codigoBloque])){
				$ret[$domicili->codigoBloque]=[
					"codigoBloque"=> $domicili->codigoBloque,
					"nombreBloque"=> $domicili->codigoBloque
				];
			}
		}
		sort($ret);
		return $ret;
	}
	

	public function getPortesVia($codigoIneVia, $numero=false, $nombrePlanta=false){
		//$via=self::getVia($codigoIneVia);
		//dd($codigoIneVia);
		$args=[
			"codigoIneVia"=>intval($codigoIneVia),
		];
		if(!isFalse($numero)) $args["numero"] =intval($numero);
		if($nombrePlanta) $args["nombrePlanta"] = ($nombrePlanta."");
		
		$domicilis=self::searchDomicilis($args);
		//dd($domicilis);
		$ret=[];
		foreach($domicilis as $domicili){
			if(isset($domicili->codigoPuerta) && $domicili->codigoPuerta && !isset($ret[$domicili->codigoPuerta])){
				$ret[$domicili->codigoPuerta]=[
					"codigoPuerta"=>$domicili->codigoPuerta,
					"nombrePuerta"=>$domicili->codigoPuerta
				];
			}
		}
		sort($ret);
		return $ret;
	}
	
	
}