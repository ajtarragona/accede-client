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



	//TODO: NO funciona
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



	//TODO: NO funciona
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



	//TODO: NO funciona
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
	
	//TODO: NO funciona
	public function getPortal($codigoPortal) {	
		$params=array(
			"codigoPortal" => $codigoPortal,
		);

		$response=$this->sendRequest("POR","LST",$params);
		return Portal::parseSingle($response);
	}



	//TODO: NO funciona
	public function getAllPortals( ) {	
		
		$params=array();

		$response=$this->sendRequest("POR","LST",$params);
		return Portal::parseResponse($response);
	}




	/***********/
	/*porta*/
	/***********/
	
	//TODO: NO funciona
	public function getPorta($codigoPuerta) {	
		$params=array(
			"codigoPuerta" => $codigoPuerta,
		);

		$response=$this->sendRequest("PTA","LST",$params);
		return Porta::parseSingle($response);
	}



	//TODO: NO funciona
	public function getAllPortes( ) {	
		
		$params=array();

		$response=$this->sendRequest("PTA","LST",$params);
		return Porta::parseResponse($response);
	}



	/***********/
	/*planta*/
	/***********/
	
	//TODO: NO funciona
	public function getPlanta($codigoPlanta) {	
		$params=array(
			"codigoPlanta" => $codigoPlanta,
		);

		$response=$this->sendRequest("PLT","LST",$params);
		return Planta::parseSingle($response);
	}



	//TODO: NO funciona
	public function getAllPlantes( ) {	
		
		$params=array();

		$response=$this->sendRequest("PLT","LST",$params);
		return Planta::parseResponse($response);
	}



	/***********/
	/*escales*/
	/***********/
	
	//TODO: NO funciona
	public function getEscala($codigoEscalera) {	
		$params=array(
			"codigoEscalera" => $codigoEscalera,
		);

		$response=$this->sendRequest("ESC","LST",$params);
		return Escala::parseSingle($response);
	}



	//TODO: NO funciona
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
		if(!$codiProvincia) $codiProvincia=$this->options->codigo_provincia_tarragona;
		if(!$codiMunicipi) $codiMunicipi=$this->options->codigo_municipio_tarragona;
		
		$params=array(
			 "codigoProvincia" => $codiProvincia,
			 "codigoMunicipio" => $codiMunicipi
		);


		$response=$this->sendRequest("CPO","LST",$params);
		return CodiPostal::parseResponse($response);
	}


	public function getCodiPostal($codigoPostal, $codiProvincia=false, $codiMunicipi=false){
		if(!$codiProvincia) $codiProvincia=$this->options->codigo_provincia_tarragona;
		if(!$codiMunicipi) $codiMunicipi=$this->options->codigo_municipio_tarragona;
		
		$params=array(
			 "codigoProvincia" => $codiProvincia,
			 "codigoMunicipio" => $codiMunicipi,
			 "codigoPostal" => $codigoPostal
		);

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
		if(!$codiProvincia) $codiProvincia=$this->options->codigo_provincia_tarragona;
		if(!$codiMunicipi) $codiMunicipi=$this->options->codigo_municipio_tarragona;
		
		$params=array(
			"codigoProvincia" => $codiProvincia,
			"codigoMunicipio" => $codiMunicipi
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
	
	
}