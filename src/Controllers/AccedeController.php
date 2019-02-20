<?php

namespace Ajtarragona\Accede\Controllers; 

use App\Http\Controllers\Controller;
use Ajtarragona\Accede\Models\AccedeTercersProvider;
use Ajtarragona\Accede\Models\AccedeVialerProvider;
use Ajtarragona\Accede\Models\AccedeRegistreProvider;
use Illuminate\Http\Request;

use AccedeTercers; //facade
use AccedeVialer; //facade
use AccedeRegistre; //facade
use \Exception;



class AccedeController extends Controller{

	public function home(){
		//$paisos=AccedeVialer::getAllPaisos();
		$currentPais=AccedeVialer::getPais(config("accede.codigo_pais_espana"));

		//$provincies=AccedeVialer::getAllProvincies();
		$currentProvincia=AccedeVialer::getProvincia(config("accede.codigo_provincia_tarragona"));
		//dump($currentProvincia);
		//$municipis=AccedeVialer::getAllMunicipis(intval($currentProvincia->codigoProvincia));
		//dd($municipis);
		$currentMunicipi=AccedeVialer::getMunicipi(config("accede.codigo_municipio_tarragona"), intval($currentProvincia->codigoProvincia));

		return view("accede-client::home",compact('currentPais','currentProvincia','currentMunicipi'));


	}

	public function pais($codigoPais){
		try{
			
			return response()->json(AccedeVialer::getPais(intval($codigoPais)));
		}catch(Exception $e){
			return response()->json([
				'error' => $e->getCode(),
				'message' => $e->getMessage()
			], 500);
		}	
	}

	public function paisos($filter=false){
		try{
			if($filter){
				$paisos=AccedeVialer::searchPaisosByName($filter);
			}else{
				$paisos=AccedeVialer::getAllPaisos();
			}

			return response()->json($paisos);
		}catch(Exception $e){
			return response()->json([
				'error' => $e->getCode(),
				'message' => $e->getMessage()
			], 500);
		}
		
	}

	public function provincia($codigoProvincia){
		try{
			return response()->json(AccedeVialer::getProvincia(intval($codigoProvincia)));
		}catch(Exception $e){
			return response()->json([
				'error' => $e->getCode(),
				'message' => $e->getMessage()
			], 500);
		}	
	}
	

	public function provincies($filter=false){
		try{
			if($filter){
				$provincies=AccedeVialer::searchProvinciesByName($filter);
			}else{
				$provincies=AccedeVialer::getAllProvincies();
			}

			return response()->json($provincies);
		}catch(Exception $e){
			return response()->json([
				'error' => $e->getCode(),
				'message' => $e->getMessage()
			], 500);
		}
		
	}

	public function municipi($codigoProvincia,$codigoMunicipio){
		try{
			return response()->json(AccedeVialer::getMunicipi(intval($codigoMunicipio),intval($codigoProvincia)));
		}catch(Exception $e){
			return response()->json([
				'error' => $e->getCode(),
				'message' => $e->getMessage()
			], 500);
		}	
	}

	public function municipis($codigoProvincia,$filter=false){
		try{
			if($filter){
				$municipis=AccedeVialer::searchMunicipisByName($filter,intval($codigoProvincia));
			}else{
				$municipis=AccedeVialer::getAllMunicipis(intval($codigoProvincia));
			}
			return response()->json($municipis);
		}catch(Exception $e){
			return response()->json([
				'error' => $e->getCode(),
				'message' => $e->getMessage()
			], 500);
		}
		
	}



	public function via($codigoProvincia,$codigoMunicipio,$codigoIneVia){
		try{
			//dd($codigoIneVia);
			return response()->json(AccedeVialer::getVia(intval($codigoIneVia),intval($codigoProvincia),intval($codigoMunicipio)));
		}catch(Exception $e){
			return response()->json([
				'error' => $e->getCode(),
				'message' => $e->getMessage()
			], 500);
		}	
	}

	public function vies($codigoProvincia,$codigoMunicipio,$filter=false){
		try{
			if($filter){
				$vies=AccedeVialer::searchViesByName($filter,intval($codigoProvincia),intval($codigoMunicipio));
			}else{
				$vies=AccedeVialer::getAllVies(intval($codigoProvincia),intval($codigoMunicipio));
			}
			return response()->json($vies);
		}catch(Exception $e){
			return response()->json([
				'error' => $e->getCode(),
				'message' => $e->getMessage()
			], 500);
		}
		
	}





	protected $defaultregisterfilter=[
		"es" => "E",
		"eje" => 2018,
		"numero" => false,
		"documento" => false
	];

	public function registerform(){
		$registres=[];

		$registerfilter=session('registerfilter',$this->defaultregisterfilter);
		$registerfilter=json_decode(json_encode($registerfilter), FALSE);

		//dd($registerfilter);
		try{
			if($registerfilter->numero && $registerfilter->eje && $registerfilter->es){
				//dd($request->all());
				$registres= AccedeRegistre::getAnotacion($registerfilter->es, $registerfilter->eje, $registerfilter->numero);
			}else if($registerfilter->documento && $registerfilter->eje){
				$registres= AccedeRegistre::getAnotacionPorDni($registerfilter->eje, $registerfilter->documento);
				//dd($registres);
			}
		}catch(Exception $e){

		}
		return view("accede-client::registre",compact('registres','registerfilter'));
	}

	
	public function searchregister(Request $request){
		session(['registerfilter'=>$request->all()]);
		return redirect()->route('accede.registerform');

	}






	public function viesCombo($codigoProvincia,$codigoMunicipio, Request $request){
		try{
			if($request->term){
				$vies=AccedeVialer::searchViesByName($request->term,intval($codigoProvincia),intval($codigoMunicipio));
			}else{
				$vies=AccedeVialer::getAllVies(intval($codigoProvincia),intval($codigoMunicipio));
			}
			
			$ret=[];
		    foreach($vies as $via){
		        $ret[] = ["value"=>$via->codigoIneVia, "name"=>$via->codigoTipoVia . " ".$via->nombreLargoVia];
		    }
		    return response()->json($ret);

		}catch(Exception $e){
			return response()->json([
				'error' => $e->getCode(),
				'message' => $e->getMessage()
			], 500);
		}
		
	}

	public function numeros($codigoIneVia){
		try{
			$numeros=AccedeVialer::getNumerosVia($codigoIneVia);
			return response()->json($numeros);
		}catch(Exception $e){
			return response()->json([
				'error' => $e->getCode(),
				'message' => $e->getMessage()
			], 500);
		}
	}
	
	public function escales($codigoIneVia, $numero=false){
		try{
			$escales=AccedeVialer::getEscalesVia($codigoIneVia, $numero);
			return response()->json($escales);
		}catch(Exception $e){
			return response()->json([
				'error' => $e->getCode(),
				'message' => $e->getMessage()
			], 500);
		}
	}

	public function plantes($codigoIneVia, $numero=false){
		try{
			$escales=AccedeVialer::getPlantesVia($codigoIneVia, $numero);
			return response()->json($escales);
		}catch(Exception $e){
			return response()->json([
				'error' => $e->getCode(),
				'message' => $e->getMessage()
			], 500);
		}
	}

	public function portes($codigoIneVia, $numero=false, $nombrePlanta=false){
		try{
			$escales=AccedeVialer::getPortesVia($codigoIneVia, $numero, $nombrePlanta);
			return response()->json($escales);
		}catch(Exception $e){
			return response()->json([
				'error' => $e->getCode(),
				'message' => $e->getMessage()
			], 500);
		}
	}

	public function codispostals($codigoIneVia, $numero=false){
		try{
			$escales=AccedeVialer::getCodisPostalsVia($codigoIneVia, $numero);
			return response()->json($escales);
		}catch(Exception $e){
			return response()->json([
				'error' => $e->getCode(),
				'message' => $e->getMessage()
			], 500);
		}
	}

	
	

}