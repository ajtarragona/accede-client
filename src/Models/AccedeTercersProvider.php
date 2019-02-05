<?php

namespace Ajtarragona\Accede\Models; 

use Ajtarragona\Accede\Models\AccedeProvider;
use Ajtarragona\Accede\Models\AccedeObject;

use Ajtarragona\Accede\Models\Beans\Tercer as TercerAccede;
use Ajtarragona\Accede\Models\Beans\Domicili as DomiciliAccede;


class AccedeTercersProvider extends AccedeProvider{
	
	
	const TIPO_DOCUMENTO_SIN_DOCUMENTO = 0;
	const TIPO_DOCUMENTO_NIF = 1;
	const TIPO_DOCUMENTO_PASAPORTE = 2;
	const TIPO_DOCUMENTO_TARJETA_RESIDENCIA = 3;
	const TIPO_DOCUMENTO_CIF = 4;
	const TIPO_DOCUMENTO_DNI = 6;


	

	public function getTercerById($id){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_TRUE,
			"codigoTercero" => "".$id,  //ha de ser string
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);
		return TercerAccede::parseSingle($response);
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



	

	

	
}