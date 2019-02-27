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
use Illuminate\Http\Request;

class AccedeVialerProvider extends AccedeProvider{
	


	public static function getCodificadors(){
		$obj=new self();
		$currentPais=$obj->getPais(config("accede.codigo_pais_espana"));
		$currentProvincia=$obj->getProvincia(config("accede.codigo_provincia_tarragona"));
		$currentMunicipi=$obj->getMunicipi(config("accede.codigo_municipio_tarragona"), intval($currentProvincia->codigoProvincia));

		$blocs=$obj->getAllBlocs(intval($currentProvincia->codigoProvincia), intval($currentMunicipi->codigoMunicipio), true);
		$escales=$obj->getAllEscales(intval($currentProvincia->codigoProvincia), intval($currentMunicipi->codigoMunicipio), true);
		$codispostals=$obj->getAllCodisPostals(intval($currentProvincia->codigoProvincia), intval($currentMunicipi->codigoMunicipio), true);
		$plantes=$obj->getAllPlantes(intval($currentProvincia->codigoProvincia), intval($currentMunicipi->codigoMunicipio), true);
		$portes=$obj->getAllPortes(intval($currentProvincia->codigoProvincia), intval($currentMunicipi->codigoMunicipio), true);
		$tipusvies=$obj->getAllTipusVia(intval($currentProvincia->codigoProvincia), intval($currentMunicipi->codigoMunicipio), true);
		return compact('currentPais','currentProvincia','currentMunicipi','blocs','escales','codispostals','plantes','portes','tipusvies');

	}


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



	public function getAllPortes( $codiProvincia=false, $codiMunicipi=false,$combo=false ) {	
		
		if(!$codiProvincia) $codiProvincia=$this->options->codigo_provincia_tarragona;
		if(!$codiMunicipi) $codiMunicipi=$this->options->codigo_municipio_tarragona;
		
		$params=array(
			 "codigoProvincia" => $codiProvincia,
			 "codigoMunicipio" => $codiMunicipi
		);

		$response=$this->sendRequest("PTA","LST",$params);

		$items=Porta::parseResponse($response);
		if($combo){
			$ret=[];
		    foreach($items as $item){
		        $ret[$item->codigoPuerta] = $item->nombrePuerta;
		    }
		}else{
			$ret=$items;
		}
		return $ret;
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



	public function getAllPlantes( $codiProvincia=false, $codiMunicipi=false,$combo=false ) {	
		
		if(!$codiProvincia) $codiProvincia=$this->options->codigo_provincia_tarragona;
		if(!$codiMunicipi) $codiMunicipi=$this->options->codigo_municipio_tarragona;
		
		$params=array(
			 "codigoProvincia" => $codiProvincia,
			 "codigoMunicipio" => $codiMunicipi
		);

		$response=$this->sendRequest("PLT","LST",$params);
		
		$items=Planta::parseResponse($response);
		if($combo){
			$ret=[];
		    foreach($items as $item){
		        $ret[$item->codigoPlanta] = $item->nombrePlanta;
		    }
		}else{
			$ret=$items;
		}
		return $ret;
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



	public function getAllEscales($codiProvincia=false, $codiMunicipi=false,$combo=false ) {	
		
		if(!$codiProvincia) $codiProvincia=$this->options->codigo_provincia_tarragona;
		if(!$codiMunicipi) $codiMunicipi=$this->options->codigo_municipio_tarragona;
		
		$params=array(
			 "codigoProvincia" => $codiProvincia,
			 "codigoMunicipio" => $codiMunicipi
		);

		$response=$this->sendRequest("ESC","LST",$params);
		$items=Escala::parseResponse($response);
		if($combo){
			$ret=[];
		    foreach($items as $item){
		        $ret[$item->codigoEscalera] = $item->nombreEscalera;
		    }
		}else{
			$ret=$items;
		}
		return $ret;
	}







	/***********/
	/*bloques*/
	/***********/

	public function getAllBlocs($codiProvincia=false, $codiMunicipi=false, $combo=false) {	
		if(!$codiProvincia) $codiProvincia=$this->options->codigo_provincia_tarragona;
		if(!$codiMunicipi) $codiMunicipi=$this->options->codigo_municipio_tarragona;
		
		$params=array(
			 "codigoProvincia" => $codiProvincia,
			 "codigoMunicipio" => $codiMunicipi
		);


		$response=$this->sendRequest("BLQ","LST",$params);
		$items=Bloc::parseResponse($response);
		if($combo){
			$ret=[];
		    foreach($items as $item){
		        $ret[$item->codigoBloque] = $item->nombreBloque;
		    }
		}else{
			$ret=$items;
		}
		return $ret;
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


	public function getAllCodisPostals($codiProvincia=false, $codiMunicipi=false, $combo=false) {	
		if(!$codiProvincia && !$codiMunicipi ){
			$codiProvincia=$this->options->codigo_provincia_tarragona;
			$codiMunicipi=$this->options->codigo_municipio_tarragona;
		}
		
		$params=array();

		if($codiProvincia) $params["codigoProvincia"] = $codiProvincia;
		if($codiMunicipi) $params["codigoMunicipio"] = $codiMunicipi;

		$response=$this->sendRequest("CPO","LST",$params);
		$items=CodiPostal::parseResponse($response);
		if($combo){
			$ret=[];
		    foreach($items as $item){
		        if(intval($item->codigoPostal)>0) $ret[$item->codigoPostal] = $item->codigoPostal;
		    }
		}else{
			$ret=$items;
		}
		return $ret;
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


	public function getAllVies($codiProvincia=false, $codiMunicipi=false , $combo=false) {	
		if(!$codiProvincia) $codiProvincia=$this->options->codigo_provincia_tarragona;
		if(!$codiMunicipi) $codiMunicipi=$this->options->codigo_municipio_tarragona;
		
		$params=array(
			"codigoProvincia" => $codiProvincia,
			"codigoMunicipio" => $codiMunicipi
		);

		$response=$this->sendRequest("VIA","LST",$params);
		$items=Via::parseResponse($response);
		if($combo){
			$ret=[];
		    foreach($items as $item){
		        $ret[$item->codigoIneVia] = $item->nombreVia;
		    }
		}else{
			$ret=$items;
		}
		return $ret;

	}




	





	/***********/
	/*tipus de via*/
	/***********/	

	public function getAllTipusVia($codiProvincia=false, $codiMunicipi=false , $combo=false) {	
		//if(!$codiProvincia) $codiProvincia=$this->options->codigo_provincia_tarragona;
		//if(!$codiMunicipi) $codiMunicipi=$this->options->codigo_municipio_tarragona;
		
		$params=array(
			//"codigoProvincia" => $codiProvincia,
			//"codigoMunicipio" => $codiMunicipi
		);


		$response=$this->sendRequest("TVI","LST",$params);

		$items=TipusVia::parseResponse($response);
		if($combo){
			$ret=[];
		    foreach($items as $item){
		        $ret[$item->codigoTipoVia] = $item->nombreTipoVia;
		    }
		}else{
			$ret=$items;
		}
		return $ret;
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


	
	public function searchDomicilis($params=[]) {

		$args=[];
		foreach($params as $key=>$param){
			if($param!==null) $args[$key]=$param;
		}
		
		if(isset($args["nombreVia"])) unset($args["nombreVia"]);
		
		if(isset($args["codigoPlanta"])){
			//$planta=AccedeVialer::getPlanta($args["codigoPlanta"]);
			$args["nombrePlanta"]=$args["codigoPlanta"];
			unset($args["codigoPlanta"]);
		}

		if(isset($args["codigoEscalera"])){
			//$escala=AccedeVialer::getEscala($args["codigoEscalera"]);
			$args["nombreEscalera"]=$args["codigoEscalera"];
			unset($args["codigoEscalera"]);
		}

		if(isset($args["numero"])){
			if(strpos($args["numero"],"-")===false){
				$args["numeroDesde"]= intval($args["numero"]);
				$args["numeroHasta"]= intval($args["numero"]);
			}else{
				$num=explode("-", $args["numero"]);
				$args["numeroDesde"] =intval($num[0]);
				$args["numeroHasta"] =intval($num[0]); //si si, 0
			}
			unset($args["numero"]);
		}
		if(isset($args["nombreVia"])) $args["nombreVia"]=strtoupper($args["nombreVia"]);
		if(isset($args["codigoIneVia"])) $args["codigoIneVia"]=intval($args["codigoIneVia"]);
		if(isset($args["numeroDesde"])) $args["numeroDesde"]=intval($args["numeroDesde"]);
		if(isset($args["numeroHasta"])) $args["numeroHasta"]=intval($args["numeroHasta"]);
		//dd($params);

		$response=$this->sendRequest("DOM","LST",$args);
		return Domicili::parseResponse($response);
	}


	public function getDomicili($codigoDomicilio){
		$domicilis=$this->searchDomicilis(["codigoDomicilio"=>intval($codigoDomicilio)]);
		if($domicilis) return $domicilis[0];
		return false;
		//if()
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



	public function createDomiciliFromRequest(Request $request){
		$via=$this->getVia(intval($request->codigoIneVia));
		//dd($via);
		$args=[
			"codigoTipoVia"=> $via->codigoTipoVia,
			"codigoIneVia"=> intval($via->codigoIneVia),
			"numeroDesde"=> intval($request->numeroDesde)
		];
		//dd($args);
		if($request->numeroHasta) $args["numeroHasta"]=intval($request->numeroHasta);
		if($request->letraDesde) $args["letraDesde"]=$request->letraDesde."";
		if($request->letraHasta) $args["letraHasta"]=$request->letraHasta."";
		if($request->codigoBloque) $args["codigoBloque"]=$request->codigoBloque."";

		if($request->codigoPlanta) $args["codigoPlanta"]=$request->codigoPlanta."";
		if($request->codigoEscalera) $args["codigoEscalera"]=$request->codigoEscalera."";
		

		if($request->codigoPuerta) $args["codigoPuerta"]=$request->codigoPuerta."";
		if($request->kilometro) $args["kilometro"]=$request->kilometro;
		if($request->codigoPostal) $args["codigoPostal"]=intval($request->codigoPostal);
		if($request->codigoTipoVivienda) $args["codigoTipoVivienda"]=intval($request->codigoTipoVivienda);
		
	
		$codigoDomicilio=$this->createDomicili($args);
		return $codigoDomicilio;
	}

	public function createDomicili($params=[]){	
		$required=["codigoTipoVia","codigoIneVia","numeroDesde"];


		$params=array_merge([
			"normalizadoDomicilio" => 1,
			"codigoPais" => $this->options->codigo_pais_espana,
			"codigoProvincia" => $this->options->codigo_provincia_tarragona,
			"codigoMunicipio" => $this->options->codigo_municipio_tarragona,
			"codigoTipoNumeracion" => 1, // 1: senars, 2: parells
			"codigoTipoVivienda" => 1 , //1:familiar, 2:colectivo



		],$params);


		if(array_diff_key(array_flip($required), $params)){
			return false;
			//dump("faltan parametros");
		}else{
			//dump("VAMOS!");
			$params["codigoTipoNumeracion"]= (intval($params["numeroDesde"]) % 2 == 0)?Domicili::TIPO_NUMERACION_PARELL:Domicili::TIPO_NUMERACION_IMPARELL;
			//dd($params);
			//codigoTipoVia
			$response=$this->sendRequest("DOM","CRE",$params,["ver"=>"2.0"]);
			//dump($response);

			//retorna el codigo de domicilio credo
			$ret=Domicili::parseCreate($response,"codigoDomicilio");

			if(intval($ret)>0) return intval($ret);
			else return false;
			
		}
	}


	public function getCodificadorsVia($codigoIneVia, $numero=false, $nombrePlanta=false){
		$args=["codigoIneVia"=>intval($codigoIneVia)];
		if(!isFalse($numero)) $args["numero"] =$numero;
		if($nombrePlanta) $args["nombrePlanta"] = ($nombrePlanta."");
		
		$numeros=[];
		$lletres=[];
		$blocs=[];
		$escales=[];
		$plantes=[];
		$cpostals=[];
		$portes=[];

		$domicilis=self::searchDomicilis($args);
		//dump($domicilis);
		
		foreach($domicilis as $domicili){
			//numero
			$thenum=[];
			if(isset($domicili->numeroDesde) && $domicili->numeroDesde )  $thenum[]=$domicili->numeroDesde;
			if(isset($domicili->numeroHasta) && $domicili->numeroHasta ) $thenum[]=$domicili->numeroHasta;
			$thenum=implode("-",$thenum);

			if($thenum && !isset($numeros[$thenum]) ){
				$numeros[$thenum]=[
					"value"=>$thenum,
					"name"=>$thenum
				];
			}	
			

			//lletra
			$letter=[];
			if(isset($domicili->letraDesde) && $domicili->letraDesde )  $letter[]=$domicili->letraDesde;
			if(isset($domicili->letraHasta) && $domicili->letraHasta ) $letter[]=$domicili->letraHasta;
			$letter=implode("-",$letter);

			if($letter &&  !isset($lletres[$letter]) ) {
				$lletres[$letter]=[
					"value"=>$letter,
					"name"=>$letter
				];
			}
			

			//plantes
			if(isset($domicili->codigoPlanta) &&  $domicili->codigoPlanta && !isset($plantes[$domicili->codigoPlanta]) ){
				$plantes[$domicili->codigoPlanta]=[
					"value"=>$domicili->codigoPlanta,
					"name"=>$domicili->nombrePlanta
				];
			}
			
			//escales
			if(isset($domicili->codigoEscalera) && $domicili->codigoEscalera && !isset($escales[$domicili->codigoEscalera])){
				$escales[$domicili->codigoEscalera]=[
					"value"=> $domicili->codigoEscalera,
					"name"=> $domicili->nombreEscalera
				];
			}
			
			//blocs
			if(isset($domicili->codigoBloque) && $domicili->codigoBloque && !isset($blocs[$domicili->codigoBloque])){
				$blocs[$domicili->codigoBloque]=[
					"value"=> $domicili->codigoBloque,
					"name"=> $domicili->codigoBloque
				];
			}
			
			//codis postals
			if(isset($domicili->codigoPostal) &&  $domicili->codigoPostal && !isset($cpostals[$domicili->codigoPostal])) {
				$cpostals[$domicili->codigoPostal]=[
					"value"=> $domicili->codigoPostal,
					"name"=> $domicili->codigoPostal
				];
			}
			
			//portes
			if(isset($domicili->codigoPuerta) && $domicili->codigoPuerta && !isset($portes[$domicili->codigoPuerta])){
				$portes[$domicili->codigoPuerta]=[
					"value"=>$domicili->codigoPuerta,
					"name"=>$domicili->codigoPuerta
				];
			}
			

		}
		//sort($numeros);
		ksort($lletres);
		ksort($blocs);
		ksort($escales);
		ksort($plantes);
		ksort($cpostals);
		ksort($portes);

		$ret=[
			"numeros"=>array_values($numeros),
			"lletres"=>array_values($lletres),
			"blocs"=>array_values($blocs),
			"escales"=>array_values($escales),
			"plantes"=>array_values($plantes),
			"cpostals"=>array_values($cpostals),
			"portes"=>array_values($portes),
		];

		return $ret;
	}


	public function getCodisPostalsVia($codigoIneVia, $numero=false){
		//$via=self::getVia($codigoIneVia);
		$args=["codigoIneVia"=>intval($codigoIneVia)];
		if(!isFalse($numero)) $args["numero"] =$numero;
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
			$thenum=[];
			if(isset($domicili->numeroDesde) && $domicili->numeroDesde )  $thenum[]=$domicili->numeroDesde;
			if(isset($domicili->numeroHasta) && $domicili->numeroHasta ) $thenum[]=$domicili->numeroHasta;
			$thenum=implode("-",$thenum);

			if($thenum && !in_array($thenum, $ret)){
				$ret[]=$thenum;
			}
		}
		//sort($ret);
		return $ret;
	}


	public function getLletresVia($codigoIneVia, $numero=false){
		//$via=self::getVia($codigoIneVia);
		$args=["codigoIneVia"=>intval($codigoIneVia)];
		if(!isFalse($numero)) $args["numero"] =$numero;
		
		$domicilis=self::searchDomicilis($args);
		$ret=[];
		foreach($domicilis as $domicili){
			$letter=[];
			if(isset($domicili->letraDesde) && $domicili->letraDesde )  $letter[]=$domicili->letraDesde;
			if(isset($domicili->letraHasta) && $domicili->letraHasta ) $letter[]=$domicili->letraHasta;
			$letter=implode("-",$letter);

			if($letter && !in_array($letter, $ret)){
				$ret[]=$letter;
			}

			//if(isset($domicili->letraDesde) && $domicili->letraDesde && !in_array($domicili->letraDesde, $ret)) $ret[]=$domicili->letraDesde;
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
		if(!isFalse($numero)) $args["numero"] =$numero;
		
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
		if(!isFalse($numero)) $args["numero"] =$numero;

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
		//if($numero) $args["numero"] =$numero;

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
		if(!isFalse($numero)) $args["numero"] =$numero;
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