<?php

namespace Ajtarragona\Accede\Controllers; 

use App\Http\Controllers\Controller;
use Ajtarragona\Accede\Models\AccedeTercersProvider;
use Ajtarragona\Accede\Models\AccedeVialerProvider;
use AccedeTercers; //facade
use AccedeVialer; //facade
use \Exception;

class AccedeTestController extends Controller
{

	public function test($filter, AccedeTercersProvider $accedetercers, AccedeVialerProvider $accedevialer){ //con inyeccion
		//dd(request()->all());
		//dd($accedetercers);
		//$tercers=$accedetercers->getTercerByNIF($filter);
		//dd($tercers);
		//dd($filter);
		try{
			$vies=AccedeVialer::searchViesByName($filter);

			return $vies;
			
			foreach($tercers as $tercer){
				$domicilios=$accedetercers->getDomicilisTercer($tercer->codigoTercero);
				$tercer->l_domicilio=$domicilios;
			}
			return $tercers;
			
		}catch(Exception $e){
			dd($e);
		}
	}

	public function testFacade($filter){ //con facade
		try{
			$vies=AccedeVialer::searchViesByName($filter);
			return $vies;

			$tercers=AccedeTercers::getTercerByNIF($filter);
			//dd($tercers);
			
			
			foreach($tercers as $tercer){
				$domicilios=AccedeTercers::getDomicilisTercer($tercer->codigoTercero);
				$tercer->l_domicilio=$domicilios;
			}
			return $tercers;
			
		}catch(Exception $e){
			dd($e);
		}
	}

	public function testHelper($filter){ //con helper
		try{
			$vies=accedevialer()->searchViesByName($filter);
			return $vies;

			$tercers=accedetercers()->getTercerByNIF($filter);
		
		
			foreach($tercers as $tercer){
				$domicilios=accedetercers()->getDomicilisTercer($tercer->codigoTercero);
				$tercer->l_domicilio=$domicilios;
			}
			return $tercers;
		}catch(Exception $e){
			dd($e);
		}
	}


}

