<?php

namespace Ajtarragona\Accede\Controllers; 

use App\Http\Controllers\Controller;
use Ajtarragona\Accede\Models\AccedeTercersProvider;
use AccedeTercers; //facade

class AccedeTestController extends Controller
{

	public function test($filter, AccedeTercersProvider $accedetercers){ //con inyeccion

		$tercers=$accedetercers->getTercerByNIF($filter);
		//dd($tercers);

		$vies=$accedetercers->searchViesByName($filter);
		if($vies) return $vies;
		
		if($tercers){
			foreach($tercers as $tercer){
				$domicilios=$accedetercers->getDomicilisTercer($tercer->codigoTercero);
				$tercer->l_domicilio=$domicilios;
			}
			return $tercers;
		}
	}

	public function testFacade($filter){ //con facade
	
		$tercers=AccedeTercers::getTercerByNIF($filter);
		//dd($tercers);
		
		if($tercers){
			foreach($tercers as $tercer){
				$domicilios=AccedeTercers::getDomicilisTercer($tercer->codigoTercero);
				$tercer->l_domicilio=$domicilios;
			}
			return $tercers;
		}
	}

	public function testHelper($filter){ //con helper
		$tercers=accedetercers()->getTercerByNIF($filter);
		
		if($tercers){
			foreach($tercers as $tercer){
				$domicilios=accedetercers()->getDomicilisTercer($tercer->codigoTercero);
				$tercer->l_domicilio=$domicilios;
			}
			return $tercers;
		}
	}
}

