<?php

namespace Ajtarragona\Accede\Controllers; 

use App\Http\Controllers\Controller;
use Ajtarragona\Accede\Models\Beans\Domicili;
use Ajtarragona\Accede\Models\Beans\Tercer;
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


class AccedeTercersController extends Controller{

	

	



	protected $defaulttercersfilter=[
		"documento" => false,
		"busqueda" => false,
		"codigoTipoDocumento" => false
		
	];
	

	public function search(){
		$params=[];
		try{
			
			$tercersfilter=session('tercersfilter',$this->defaulttercersfilter);
			$params["tercersfilter"]=json_decode(json_encode($tercersfilter), FALSE);
			
			$params["tipusDocuments"] = AccedeTercers::getAllTipusDocument(true);

			$tercers=[];	

			if($tercersfilter["documento"] && $tercersfilter["codigoTipoDocumento"] ){

				$tercers=AccedeTercers::getTercerByDocument($tercersfilter["documento"], $tercersfilter["codigoTipoDocumento"]);
				
			}else if($tercersfilter["busqueda"]){
				$tercers=AccedeTercers::searchTercersByFullName($tercersfilter["busqueda"]);
				
			}

			$params["tercers"]=$tercers;
			
			return view("accede-client::tercers.index",$params);

		}catch(AccedeNoResultsException $e){
			return view("accede-client::tercers.index",$params);
		}catch(AccedeErrorException $e){
			$error=$e->getMessage();
			return view("accede-client::erroraccede",compact('error'));
		}
	}



	public function dosearch(Request $request){
		//dd($request->all());
		$filter=array_merge($this->defaulttercersfilter,$request->except(['_token','_method']));
		//dd($filter);
		session(['tercersfilter'=>$filter]);
		return redirect()->route('accede.tercer.search');
	}




	public function create(){
		try{
			$args=[];
			$args["tercer"]=new Tercer();

			return view("accede-client::tercers.new",$args);

		}catch(AccedeErrorException $e){
			$error=$e->getMessage();
			return view("accede-client::erroraccede",compact('error'));
		}
	}


	public function newmodal(){
		try{
			$args=[];
			$args["tercer"]=new Tercer();
			$args["tipusDocuments"] = AccedeTercers::getAllTipusDocument(true);

			return view("accede-client::tercers.modalnew",$args);

		}catch(AccedeErrorException $e){
			return response()->json([
				'error' => $e->getCode(),
				'message' => $e->getMessage()
			], 500);
		}
	}


	public function show($codigoTercero){
		try{
			//dd($codigoDomicilio);
			$args["tercer"]=AccedeTercers::getTercerById($codigoTercero);
			$args["tipusDocuments"] = AccedeTercers::getAllTipusDocument(true);

			return view("accede-client::tercers.show",$args);

		}catch(AccedeErrorException $e){
			$error=$e->getMessage();
			return view("accede-client::erroraccede",compact('error'));
		}
	}





	public function store(Request $request){
		//dd($request->all());
		//dd($tercer);
		try{
			
			$codigoTercero=AccedeTercers::createTercer($request->all());
			
			return redirect()->route('accede.tercer.search')
	                    ->with(['success'=>"Tercer ".$codigoTercero. "creat"]);
	    }catch(AccedeErrorException $e){
			return redirect()
                ->route('accede.tercer.search')
                ->with(['error'=>"ACCEDE: ".$e->getMessage()]); 
		}catch(Exception $e){
           return redirect()
                ->route('accede.tercer.search')
                ->with(['error'=>"Error creant tercer"]); 
        }    


	}




	public function newdomicili($codigoTercero){
		try{
			$args=AccedeVialer::getCodificadors();
			$args["tercer"]=AccedeTercers::getTercerById($codigoTercero);
			$args["tipusDocuments"] = AccedeTercers::getAllTipusDocument(true);
			$args["domicili"] = new Domicili();

			return view("accede-client::tercers.modalnewdomicili",$args);

		}catch(AccedeErrorException $e){
			return response()->json([
				'error' => $e->getCode(),
				'message' => $e->getMessage()
			], 500);
		}
	}


	public function save($codigoTercero,Request $request){
		//dd($request->all());
		//dd($tercer);
		try{
			
			$tercer=Tercer::cast($request->all());	
			$tercer->codigoTercero=$codigoTercero;
			$tercer->setDomicilis(false,true);
			
			//dd($tercer);

			$return=AccedeTercers::updateTercer($tercer);

			return redirect()
	                ->route('accede.tercer.show',[$codigoTercero])
	                ->with(['success'=>"Tercer modificat correctament"]); 
	    }catch(AccedeErrorException $e){
			return redirect()
                ->route('accede.tercer.show',[$codigoTercero])
                ->with(['error'=>"ACCEDE: ".$e->getMessage()]); 
		}catch(Exception $e){
           return redirect()
                ->route('accede.tercer.show',[$codigoTercero])
                ->with(['error'=>"Error modificant tercer"]); 
        }    


	}


	public function storedomicili($codigoTercero, Request $request){
		try{
			
			$codigoDomicilio=AccedeVialer::createDomiciliFromRequest($request);
			$tercer=AccedeTercers::getTercerById($codigoTercero);

			$tercer->setDomicilis($codigoDomicilio,true);

			$return=AccedeTercers::updateTercer($tercer);
			//dd($tercer);
			return redirect()->route('accede.tercer.show',[$codigoTercero])
	                    ->with(['success'=>"Domicili ".$codigoDomicilio. " creat i afegit al tercer ".$codigoTercero]);
	    }catch(AccedeNoResultsException $e){
			return redirect()
                ->route('accede.tercer.show',[$codigoTercero])
                ->with(['error'=>"Has de triar el carrer"]); 
		}catch(AccedeErrorException $e){
			return redirect()
                ->route('accede.tercer.show',[$codigoTercero])
                ->with(['error'=>"ACCEDE: ".$e->getMessage()]); 
		}catch(Exception $e){
           return redirect()
                ->route('accede.tercer.show',[$codigoTercero])
                ->with(['error'=>"Error creant domicili"]); 
        }   
			
	}


	public function searchdomicilis($codigoTercero, Request $request){
		$args=[];
		$args["domicilis"]=[];
		try{
			//dd($request->all());
			$args["tercer"]=AccedeTercers::getTercerById($codigoTercero);
			$args["domicilis"] = AccedeVialer::searchDomicilis($request->all());

			return view("accede-client::tercers._searchdomicilisresults",$args);

		}catch(AccedeNoResultsException $e){
			return view("accede-client::tercers._searchdomicilisresults",$args);

		}catch(AccedeErrorException $e){
			return view("accede-client::tercers._searchdomicilisresults",$args);

		}
	}

	public function updatedomicili($codigoTercero, $codigoDomicilio, Request $request){
		try{
			//dd($request->all());
			$tercer=AccedeTercers::getTercerById($codigoTercero);

			if($request->submitaction=="remove"){
				$tercer->removeDomicili($codigoDomicilio,true);
				
				
				//dd($tercer);
				$return=AccedeTercers::updateTercer($tercer);
				return redirect()
	                ->route('accede.tercer.show',[$codigoTercero])
	                ->with(['success'=>"Tercer modificat correctament"]); 
	        }else if($request->submitaction=="setprincipal"){
	        	$return=AccedeTercers::definirDomiciliPrincipal($codigoTercero, $codigoDomicilio);
	        	return redirect()
	                ->route('accede.tercer.show',[$codigoTercero])
	                ->with(['success'=>"Tercer modificat correctament"]); 

	        }else{
	        	return redirect()
	                ->route('accede.tercer.show',[$codigoTercero]);
	        }

		}catch(AccedeNoResultsException $e){
			return redirect()
                ->route('accede.tercer.show',[$codigoTercero])
                ->with(['error'=>"Has de triar el carrer"]); 
		}catch(AccedeErrorException $e){
			return redirect()
                ->route('accede.tercer.show',[$codigoTercero])
                ->with(['error'=>"ACCEDE: ".$e->getMessage()]); 
		}catch(Exception $e){
           return redirect()
                ->route('accede.tercer.show',[$codigoTercero])
                ->with(['error'=>"Error creant domicili"]); 
        }   
	}
	

	public function assigndomicilis($codigoTercero, Request $request){
		try{
			//dd($request->all());
			$tercer=AccedeTercers::getTercerById($codigoTercero);
			$tercer->setDomicilis($request->codigoDomicilio,true);
			

			//dd($tercer);
			$return=AccedeTercers::updateTercer($tercer);
			return redirect()
                ->route('accede.tercer.show',[$codigoTercero])
                ->with(['success'=>"Tercer modificat correctament"]); 

		}catch(AccedeNoResultsException $e){
			return redirect()
                ->route('accede.tercer.show',[$codigoTercero])
                ->with(['error'=>"Has de triar el carrer"]); 
		}catch(AccedeErrorException $e){
			return redirect()
                ->route('accede.tercer.show',[$codigoTercero])
                ->with(['error'=>"ACCEDE: ".$e->getMessage()]); 
		}catch(Exception $e){
           return redirect()
                ->route('accede.tercer.show',[$codigoTercero])
                ->with(['error'=>"Error creant domicili"]); 
        }   
	}








}