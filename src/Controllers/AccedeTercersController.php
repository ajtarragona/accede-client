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
		
	];
	

	public function search(){
		$params=[];
		try{
			
			$tercersfilter=session('tercersfilter',$this->defaulttercersfilter);
			$params["tercersfilter"]=json_decode(json_encode($tercersfilter), FALSE);
		
			$tercers=[];	

			if($tercersfilter["documento"]){
				$tercers=AccedeTercers::getTercerByNIF($tercersfilter["documento"]);
				
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

			return view("accede-client::tercers.show",$args);

		}catch(AccedeErrorException $e){
			$error=$e->getMessage();
			return view("accede-client::erroraccede",compact('error'));
		}
	}





	public function store(Request $request){
		//dump($request->all());
		try{
			
			$codigoTercero=AccedeTercers::createTercer($args);
			
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

















}