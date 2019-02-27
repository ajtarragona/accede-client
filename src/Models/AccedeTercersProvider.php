<?php

namespace Ajtarragona\Accede\Models; 

use Ajtarragona\Accede\Models\AccedeProvider;
use Ajtarragona\Accede\Models\AccedeObject;

use Ajtarragona\Accede\Models\Beans\Tercer as TercerAccede;
use Ajtarragona\Accede\Models\Beans\Domicili as DomiciliAccede;
use Ajtarragona\Accede\Models\Beans\TipusDocument;
use Ajtarragona\Accede\Exceptions\AccedeNoResultsException;


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
		$tercer=TercerAccede::parseSingle($response);
		unset($tercer->l_domicilio);
		return $tercer;
	} 


	private static function removeDomicilis($tercers){
		foreach($tercers as $tercer){
			unset($tercer->l_domicilio);
		}
		return $tercers;
	}


	public function searchTercersByName($name){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,
			"nombre" => "%".$name,
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);
		$ret=self::removeDomicilis(TercerAccede::parseResponse($response));
		
		return $ret;
	}


	public function searchTercersBySurname1($surname){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,
			"apellido1" => "%".$surname,
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);
		return self::removeDomicilis(TercerAccede::parseResponse($response));
	}



	public function searchTercersBySurname2($surname){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,
			"apellido2" => "%".$surname,
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);

		return self::removeDomicilis(TercerAccede::parseResponse($response));
	}



	public function searchTercersBySurnames($surname1, $surname2){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,
			"apellido1" => "%".$surname,
			"apellido2" => "%".$surname,
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);
		return self::removeDomicilis(TercerAccede::parseResponse($response));
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
		
		return self::removeDomicilis(TercerAccede::parseResponse($response));
	}



	public function getTercerByPasaporte($pasaporte){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,
			"codigoTipoDocumento" => self::TIPO_DOCUMENTO_PASAPORTE,
			"documento" => $pasaporte,
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);
		return self::removeDomicilis(TercerAccede::parseResponse($response));
	}

	

	public function getTercerByTarjetaResidencia($tresidencia){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,
			"codigoTipoDocumento" => self::TIPO_DOCUMENTO_TARJETA_RESIDENCIA,
			"documento" => $tresidencia,
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);
		return self::removeDomicilis(TercerAccede::parseResponse($response));
	}
	


	public function getTercerByCIF($cif){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,
			"codigoTipoDocumento" => self::TIPO_DOCUMENTO_CIF,
			"documento" => $cif,
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);
		return self::removeDomicilis(TercerAccede::parseResponse($response));
	}
	


	public function getTercerByDNI($dni){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,
			"codigoTipoDocumento" => self::TIPO_DOCUMENTO_DNI,
			"documento" => $dni,
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);
		return self::removeDomicilis(TercerAccede::parseResponse($response));
	}



	public function getTercerByNIF($nif){
		$params=array(
			"busquedaExacta" => AccedeObject::ACCEDE_BOOL_FALSE,
			"codigoTipoDocumento" => self::TIPO_DOCUMENTO_NIF,
			"documento" => $nif,
			"obtenerDomicilios" => AccedeObject::ACCEDE_BOOL_FALSE
		);
		$response=$this->sendRequest("TER","LST",$params);
		return self::removeDomicilis(TercerAccede::parseResponse($response));
		
		
	}


	public function getTercerByDocument($documento, $codigoTipoDocumento = self::TIPO_DOCUMENTO_NIF){
		
		$ret=false;
		switch($codigoTipoDocumento){
			case self::TIPO_DOCUMENTO_DNI: $ret=$this->getTercerByDNI($documento); break;
			case self::TIPO_DOCUMENTO_CIF: $ret=$this->getTercerByCIF($documento); break;
			case self::TIPO_DOCUMENTO_PASAPORTE: $ret=$this->getTercerByPasaporte($documento); break;
			case self::TIPO_DOCUMENTO_TARJETA_RESIDENCIA: $ret=$this->getTercerByTarjetaResidencia($documento); break;
			case self::TIPO_DOCUMENTO_NIF:
			default: $ret=$this->getTercerByNIF($documento); break;
		}
		return $ret;
	}



	public function searchTercers($filter){

		$tercers=collect();
		//dump($filter);
		try{
			$tercers=collect($this->searchTercersByFullName($filter));
			//dump($tercers);
		}catch(AccedeNoResultsException | Exception $e){

		}
		try{
			$tercers=$tercers->merge($this->getTercerByDocument($filter));
			
		}catch(AccedeNoResultsException | Exception $e){
			
		}
		//$ret=array_merge($tercers,$tercers2);
		
		return $tercers->unique();
	}





	public function getDomicilisTercer($id){
		$params=array(
			"codigoTercero" => (int)$id
		);
		$response=$this->sendRequest("TER","DOM",$params);
		return DomiciliAccede::parseResponse($response);
		
	}


	

	

	public function createTercer($array){
		$tercer=TercerAccede::cast($array);
		//$params=TercerAccede::toArray($tercer);
		
		$params=array(
			"codigoTipoDocumento" => isset($tercer->codigoTipoDocumento)?intval($tercer->codigoTipoDocumento):self::TIPO_DOCUMENTO_NIF,
			"documento" => isset($tercer->documento)?$tercer->documento:'',
			"nombre" => isset($tercer->nombre)?$tercer->nombre:'',
			"particula1" => isset($tercer->particula1)?$tercer->particula1:'',
			"apellido1" => isset($tercer->apellido1)?$tercer->apellido1:'',
			"particula2" => isset($tercer->particula2)?$tercer->particula2:'',
			"apellido2" => isset($tercer->apellido2)?$tercer->apellido2:'',
			"telefono" => isset($tercer->telefono)?$tercer->telefono:'',
			"email" => isset($tercer->email)?$tercer->email:'',
			"normalizadoTercero" => isset($tercer->normalizadoTercero)?intval($tercer->normalizadoTercero):AccedeObject::ACCEDE_BOOL_TRUE
		);
		if(isset($tercer->l_domicilio)){
			$params["l_domicilio"]=$tercer->l_domicilio;
		}

		$response=$this->sendRequest("TER","CRE",$params);
		return TercerAccede::parseCreate($response);
	}	


	public function updateTercer($tercer){
		//dd($tercer);
		$params=array(
			"codigoTercero" => intval($tercer->codigoTercero),
			"codigoTipoDocumento" => isset($tercer->codigoTipoDocumento)?intval($tercer->codigoTipoDocumento):self::TIPO_DOCUMENTO_NIF,
			"documento" => isset($tercer->documento)?$tercer->documento:'',
			"nombre" => isset($tercer->nombre)?$tercer->nombre:'',
			"particula1" => isset($tercer->particula1)?$tercer->particula1:'',
			"apellido1" => isset($tercer->apellido1)?$tercer->apellido1:'',
			"particula2" => isset($tercer->particula2)?$tercer->particula2:'',
			"apellido2" => isset($tercer->apellido2)?$tercer->apellido2:'',
			"telefono" => isset($tercer->telefono)?$tercer->telefono:'',
			"email" => isset($tercer->email)?$tercer->email:'',
			"normalizadoTercero" => isset($tercer->normalizadoTercero)?intval($tercer->normalizadoTercero):AccedeObject::ACCEDE_BOOL_TRUE
		);

		if(isset($tercer->l_domicilio)){
			//parche:pasar codigos de domicilio a string
			foreach($tercer->l_domicilio as $i=>$dom){
				$tercer->l_domicilio[$i]["codigoDomicilio"] = "".$dom["codigoDomicilio"];
				$tercer->l_domicilio[$i]["codigoTipoOcupacion"] = "".$dom["codigoTipoOcupacion"];
				//$dom["codigoDomicilio"] = "".$dom["codigoDomicilio"];
			}
			$params["l_domicilio"]=$tercer->l_domicilio;
		}

		//dd($params);
		$response=$this->sendRequest("TER","MOD",$params);
		return TercerAccede::parseUpdate($response);

	}


	public function deleteTercer($codigoTercero){
		$params=[
			"codigoTercero"=> $codigoTercero
		];
		$response=$this->sendRequest("TER","DEL",$params);
		return TercerAccede::parseDelete($response);
	}


	public function definirDomiciliPrincipal($codigoTercero, $codigoDomicilio){
		$params=[
			"codigoTercero"=> intval($codigoTercero),
			"codigoDomicilio"=> intval($codigoDomicilio)
		];
		$response=$this->sendRequest("TER","MDOP",$params);
		return TercerAccede::parseUpdate($response);
	}



	
	public function getAllTipusDocument($combo=false){
		$params=array();
		$response=$this->sendRequest("TID","LST",$params);
		$items=TipusDocument::parseResponse($response);

		if($combo){
			$ret=[];
		    foreach($items as $item){
		        $ret[$item->codigoTipoDocumento] = $item->nombreTipoDocumento;
		    }
		}else{
			$ret=$items;
		}
		return $ret;
	}



	public function getTipusDocument($codigoTipoDocumento){
		$params=array(
			"codigoTipoDocumento" => $codigoTipoDocumento
		);
		$response=$this->sendRequest("TID","LST",$params);
		return TipusDocument::parseSingle($response);

	}

	

	
}