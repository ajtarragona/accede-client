<?php

namespace Ajtarragona\AccedeTercers\Models\Accede; 

use Ajtarragona\AccedeTercers\Models\Accede\AccedeObject;
use Ajtarragona\AccedeTercers\Models\Accede\Request as AccedeRequest;
use Ajtarragona\AccedeTercers\Models\Accede\Security as AccedeSecurity;
use Ajtarragona\AccedeTercers\Models\Accede\Operation as AccedeOperation;
use Ajtarragona\AccedeTercers\Models\Accede\Response as AccedeResponse;
use Ajtarragona\AccedeTercers\Models\Accede\Beans\Tercer as TercerAccede;
use Ajtarragona\AccedeTercers\Models\Accede\Beans\Domicili as DomiciliAccede;
use Ajtarragona\AccedeTercers\Models\Accede\Beans\Via as ViaAccede;


class AccedeTercersProvider {
	
	private $options;
	
	const TIPO_DOCUMENTO_SIN_DOCUMENTO = 0;
	const TIPO_DOCUMENTO_NIF = 1;
	const TIPO_DOCUMENTO_PASAPORTE = 2;
	const TIPO_DOCUMENTO_TARJETA_RESIDENCIA = 3;
	const TIPO_DOCUMENTO_CIF = 4;
	const TIPO_DOCUMENTO_DNI = 6;


	public function __construct($options=array()) { 
		$opts=config('accede-tercers');
		if($options) $opts=array_merge($opts,$options);
		$this->options= json_decode(json_encode($opts), FALSE);
	}


	private function sendRequest($tobj,$cmd, $params=false){
		$op=new AccedeOperation("TER",$tobj, $cmd,"2.0");
		$sec=new AccedeSecurity($this->options);
		
		$request= new AccedeRequest($op,$sec,$params);
		//dd($request);
		$request->setWSUrl($this->options->ws_url."?wsdl");
		//dd($request);
		return $request->send();
	}



	


	public function getTercerById($id){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_TRUE,
			"codigoTercero" => "".$id,  //ha de ser string
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);
		return TercerAccede::parseResponse($response, true);
	} 


	
	public function searchTercersByName($name){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,
			"nombre" => "%".$name,
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);
		return TercerAccede::parseResponse($response);
	}


	public function searchTercersBySurname1($surname){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,
			"apellido1" => "%".$surname,
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);
		return TercerAccede::parseResponse($response);
	}



	public function searchTercersBySurname2($surname){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,
			"apellido2" => "%".$surname,
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);

		return TercerAccede::parseResponse($response);
	}



	public function searchTercersBySurnames($surname1, $surname2){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,
			"apellido1" => "%".$surname,
			"apellido2" => "%".$surname,
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);
		return TercerAccede::parseResponse($response);
	}



	public function searchTercersByFullName($filter){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,
			"normalizado" => 0,
			"nombre" => "%".$filter,
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		//dd($params);
		$response=$this->sendRequest("TER","LST",$params);
		
		return TercerAccede::parseResponse($response);
	}



	public function getTercerByPasaporte($pasaporte){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,
			"codigoTipoDocumento" => self::TIPO_DOCUMENTO_PASAPORTE,
			"documento" => $pasaporte,
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);
		return TercerAccede::parseResponse($response);
	}

	

	public function getTercerByTarjetaResidencia($tresidencia){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,
			"codigoTipoDocumento" => self::TIPO_DOCUMENTO_TARJETA_RESIDENCIA,
			"documento" => $tresidencia,
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);
		return TercerAccede::parseResponse($response);
	}
	


	public function getTercerByCIF($cif){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,
			"codigoTipoDocumento" => self::TIPO_DOCUMENTO_CIF,
			"documento" => $cif,
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);
		return TercerAccede::parseResponse($response);
	}
	


	public function getTercerByDNI($dni){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,
			"codigoTipoDocumento" => self::TIPO_DOCUMENTO_DNI,
			"documento" => $dni,
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);
		return TercerAccede::parseResponse($response);
	}



	public function getTercerByNIF($nif){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,
			"codigoTipoDocumento" => self::TIPO_DOCUMENTO_NIF,
			"documento" => $nif,
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);
		return TercerAccede::parseResponse($response);
		
		
	}







	public function getDomicilisTercer($id){
		$params=array(
			"codigoTercero" => (int)$id
		);
		$response=$this->sendRequest("TER","DOM",$params);
		return DomiciliAccede::parseResponse($response);
		
	}


	

	public function getDomicilisByVia($codiVia,$numeroDesde=false,$numeroHasta=false) {	
		$params=array(
			"codigoVia" => $codiVia
		);
		if($numeroDesde){
			$params["numeroDesde"]= $numeroDesde;
			$params["numeroHasta"]= $numeroHasta?$numeroHasta:$numeroDesde;
		}
		$response=$this->sendRequest("DOM","LST",$params);
		return DomiciliAccede::parseResponse($response);
	}
	

	public function createTercer($tercer){
		$params=array(
			"codigoTipoDocumento" => isset($tercer->codigoTipoDocumento)?$tercer->codigoTipoDocumento:self::TIPO_DOCUMENTO_NIF,
			"documento" => isset($tercer->documento)?$tercer->documento:'',
			"nombre" => isset($tercer->nombre)?$tercer->nombre:'',
			"particula1" => isset($tercer->particula1)?$tercer->particula1:'',
			"apellido1" => isset($tercer->apellido1)?$tercer->apellido1:'',
			"particula2" => isset($tercer->particula2)?$tercer->particula2:'',
			"apellido2" => isset($tercer->apellido2)?$tercer->apellido2:'',
			"telefono" => isset($tercer->telefono)?$tercer->telefono:'',
			"email" => isset($tercer->email)?$tercer->email:'',
			"normalizadoTercero" => isset($tercer->normalizadoTercero)?$tercer->normalizadoTercero:AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","CRE",$params);
		return TercerAccede::parseCreate($response);
	}	

	public function updateTercer($tercer){}
	public function deleteTercer($id){}



	public function searchViesByName($filter, $codiProvincia=false, $codiMunicipi=false ) {	
		if(!$codiProvincia) $codiProvincia=$this->options->codigo_provincia_tarragona;
		if(!$codiMunicipi) $codiMunicipi=$this->options->codigo_municipio_tarragona;
		
		$params=array(
			"nombreVia" => strtoupper("%".$filter."%"),
			"codigoProvincia" => $codiProvincia,
			"codigoMunicipio" => $codiMunicipi
		);

		$response=$this->sendRequest("VIA","LST",$params);
		return ViaAccede::parseResponse($response);
	}

	
	public function getAllVies($codiProvincia=false, $codiMunicipi=false ) {	
		if(!$codiProvincia) $codiProvincia=$this->options->codigo_provincia_tarragona;
		if(!$codiMunicipi) $codiMunicipi=$this->options->codigo_municipio_tarragona;
		
		$params=array(
			"codigoProvincia" => $codiProvincia,
			"codigoMunicipio" => $codiMunicipi
		);

		$response=$this->sendRequest("VIA","LST",$params);
		return ViaAccede::parseResponse($response);
	}


	

	
}