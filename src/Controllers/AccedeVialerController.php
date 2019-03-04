<?php

namespace Ajtarragona\Accede\Controllers; 

use App\Http\Controllers\Controller;
use Ajtarragona\Accede\Models\Beans\Domicili;
use Ajtarragona\Accede\Models\AccedeTercersProvider;
use Ajtarragona\Accede\Models\AccedeVialerProvider;
use Ajtarragona\Accede\Models\AccedeRegistreProvider;
use Illuminate\Http\Request;

use AccedeTercers; //facade
use AccedeVialer; //facade
use AccedeRegistre; //facade
use Ajtarragona\Accede\Exceptions\AccedeErrorException;
use Ajtarragona\Accede\Exceptions\AccedeNoResultsException;
use \Artisan;


class AccedeVialerController extends Controller{



	public function home(){
		try{

			//$paisos=AccedeVialer::getAllPaisos();
			$currentPais=AccedeVialer::getPais(config("accede.codigo_pais_espana"));

			//$provincies=AccedeVialer::getAllProvincies();
			$currentProvincia=AccedeVialer::getProvincia(config("accede.codigo_provincia_tarragona"));
			//dump($currentProvincia);
			//$municipis=AccedeVialer::getAllMunicipis(intval($currentProvincia->codigoProvincia));
			//dd($municipis);
			$currentMunicipi=AccedeVialer::getMunicipi(config("accede.codigo_municipio_tarragona"), intval($currentProvincia->codigoProvincia));


			/*quitar en producció!!*/
			/*Artisan::call('vendor:publish', [
			    '--tag' => 'ajtarragona-accede-assets', 
			    '--force' => 1
			]);

			Artisan::call('vendor:publish', [
			    '--tag' => 'ajtarragona-web-components-assets', 
			    '--force' => 1
			]);*/
			/**/

			return view("accede-client::vialer",compact('currentPais','currentProvincia','currentMunicipi'));

		}catch(AccedeErrorException $e){
			$error=$e->getMessage();
			return view("accede-client::erroraccede",compact('error'));
		}

	}



	



	


	protected $defaultdomicilisfilter=[
		"codigoIneVia" => false,
		"content_codigoIneVia" => false,
		"nombreVia" => false,
		"numeroDesde" => false,
		"numeroHasta" => false,
		"letraDesde" => false,
		"letraHasta" => false,
		"codigoBloque" => false,
		"codigoEscalera" => false,
		"codigoPlanta" => false,
		"codigoPuerta" => false,
		"kilometro" => false,
		"codigoPostal" => false,
	];
	

	public function search(){
		$params=[];
		try{
			$params=AccedeVialer::getCodificadors();
			
			$domicilisfilter=session('domicilisfilter',$this->defaultdomicilisfilter);
			$domicilisfilter["nombreVia"]=$domicilisfilter["content_codigoIneVia"];
			$params["domicilisfilter"]=json_decode(json_encode($domicilisfilter), FALSE);
		
			
			$domicilis=AccedeVialer::searchDomicilis($domicilisfilter);
			$params["domicilis"]=$domicilis;
			

			return view("accede-client::domicilis.index",$params);

		}catch(AccedeNoResultsException $e){
			return view("accede-client::domicilis.index",$params);
		}catch(AccedeErrorException $e){
			$error=$e->getMessage();
			return view("accede-client::erroraccede",compact('error'));
		}
	}



	public function dosearch(Request $request){
		//dd($request->all());
		$filter=array_merge($this->defaultdomicilisfilter,$request->except(['_token','_method']));
		//dd($filter);
		session(['domicilisfilter'=>$filter]);
		return redirect()->route('accede.domicili.search');
	}




	public function create(){
		try{
			$args=AccedeVialer::getCodificadors();
			$args["domicili"]=new Domicili();

			return view("accede-client::domicilis.new",$args);

		}catch(AccedeErrorException $e){
			$error=$e->getMessage();
			return view("accede-client::erroraccede",compact('error'));
		}
	}


	public function newmodal(){
		try{
			$args=AccedeVialer::getCodificadors();
			$args["domicili"]=new Domicili();

			return view("accede-client::domicilis.modalnew",$args);

		}catch(AccedeErrorException $e){
			return response()->json([
				'error' => $e->getCode(),
				'message' => $e->getMessage()
			], 500);
		}
	}


	public function show($codigoDomicilio){
		try{
			$args=AccedeVialer::getCodificadors();
			//dd($codigoDomicilio);
			$args["domicili"]=AccedeVialer::getDomicili($codigoDomicilio);

			return view("accede-client::domicilis.show",$args);

		}catch(AccedeErrorException $e){
			$error=$e->getMessage();
			return view("accede-client::erroraccede",compact('error'));
		}
	}





	public function store(Request $request){
		//dump($request->all());
		try{
			
			$codigoDomicilio=AccedeVialer::createDomiciliFromRequest($request);
			
			return redirect()->route('accede.domicili.search')
	                    ->with(['success'=>"Domicili ".$codigoDomicilio. "creat"]);
	    }catch(AccedeNoResultsException $e){
			return redirect()
                ->route('accede.domicili.search')
                ->with(['error'=>"Has de triar el carrer"]); 
		}catch(AccedeErrorException $e){
			return redirect()
                ->route('accede.domicili.search')
                ->with(['error'=>"ACCEDE: ".$e->getMessage()]); 
		}catch(Exception $e){
           return redirect()
                ->route('accede.domicili.search')
                ->with(['error'=>"Error creant domicili"]); 
        }    


	}
















}