<?php

namespace Ajtarragona\Accede\Controllers; 

use Illuminate\Routing\Controller;
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


class AccedeRegistreController extends Controller{

	protected $defaultregisterfilter=[
		"es" => "E",
		"eje" => 2018,
		"numero" => false,
		"documento" => false
	];

	public function search(){
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
			return view("accede-client::registre.index",compact('registres','registerfilter'));
			
		}catch(AccedeNoResultsException $e){
			return view("accede-client::registre.index",compact('registres','registerfilter'));

		}catch(AccedeErrorException $e){
			return view("accede-client::registre.index",compact('registres','registerfilter'));

		}
	}




	
	public function dosearch(Request $request){
		session(['registerfilter'=>$request->all()]);
		return redirect()->route('accede.register.search');

	}


}