<?php

namespace Ajtarragona\AccedeTercers\Controllers; 

use App\Http\Controllers\Controller;
use Ajtarragona\AccedeTercers\Models\Accede\AccedeTercersProvider;
use AccedeTercers; //facade

class AccedeTestController extends Controller
{

	public function test($filter, AccedeTercersProvider $accede){ //con inyeccion

		$tercers=$accede->getTercerByNIF($filter);
		//dd($tercers);

		$vies=$accede->searchViesByName($filter);
		if($vies) return $vies;
		
		if($tercers){
			foreach($tercers as $tercer){
				$domicilios=$accede->getDomicilisTercer($tercer->codigoTercero);
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
		$tercers=accede()->getTercerByNIF($filter);
		
		if($tercers){
			foreach($tercers as $tercer){
				$domicilios=accede()->getDomicilisTercer($tercer->codigoTercero);
				$tercer->l_domicilio=$domicilios;
			}
			return $tercers;
		}
	}
}

