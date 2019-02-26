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
			Artisan::call('vendor:publish', [
			    '--tag' => 'ajtarragona-accede-assets', 
			    '--force' => 1
			]);
			/**/

			return view("accede-client::vialer",compact('currentPais','currentProvincia','currentMunicipi'));

		}catch(AccedeErrorException $e){
			$error=$e->getMessage();
			return view("accede-client::erroraccede",compact('error'));
		}

	}



	private function getCodificadors(){
		$currentPais=AccedeVialer::getPais(config("accede.codigo_pais_espana"));
		$currentProvincia=AccedeVialer::getProvincia(config("accede.codigo_provincia_tarragona"));
		$currentMunicipi=AccedeVialer::getMunicipi(config("accede.codigo_municipio_tarragona"), intval($currentProvincia->codigoProvincia));

		$blocs=AccedeVialer::getAllBlocs(intval($currentProvincia->codigoProvincia), intval($currentMunicipi->codigoMunicipio), true);
		$escales=AccedeVialer::getAllEscales(intval($currentProvincia->codigoProvincia), intval($currentMunicipi->codigoMunicipio), true);
		$codispostals=AccedeVialer::getAllCodisPostals(intval($currentProvincia->codigoProvincia), intval($currentMunicipi->codigoMunicipio), true);
		$plantes=AccedeVialer::getAllPlantes(intval($currentProvincia->codigoProvincia), intval($currentMunicipi->codigoMunicipio), true);
		$portes=AccedeVialer::getAllPortes(intval($currentProvincia->codigoProvincia), intval($currentMunicipi->codigoMunicipio), true);
		$tipusvies=AccedeVialer::getAllTipusVia(intval($currentProvincia->codigoProvincia), intval($currentMunicipi->codigoMunicipio), true);
		return compact('currentPais','currentProvincia','currentMunicipi','blocs','escales','codispostals','plantes','portes','tipusvies');

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
			$params=$this->getCodificadors();
			
			$domicilisfilter=session('domicilisfilter',$this->defaultdomicilisfilter);
			$domicilisfilter["nombreVia"]=$domicilisfilter["content_codigoIneVia"];
			$params["domicilisfilter"]=json_decode(json_encode($domicilisfilter), FALSE);
		
			$args=[];
			foreach($domicilisfilter as $key=>$param){
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

			//dd($params);
			//dd($args);

			$domicilis=AccedeVialer::searchDomicilis($args);
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
			$args=$this->getCodificadors();
			$args["domicili"]=new Domicili();

			return view("accede-client::domicilis.new",$args);

		}catch(AccedeErrorException $e){
			$error=$e->getMessage();
			return view("accede-client::erroraccede",compact('error'));
		}
	}


	public function newmodal(){
		try{
			$args=$this->getCodificadors();
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
			$args=$this->getCodificadors();
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
			$via=AccedeVialer::getVia(intval($request->codigoIneVia));
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
			
		
			$codigoDomicilio=AccedeVialer::createDomicili($args);
			
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