<?php

namespace Ajtarragona\Accede\Controllers; 

use App\Http\Controllers\Controller;
use Ajtarragona\Accede\Models\AccedeTercersProvider;
use Ajtarragona\Accede\Models\AccedeVialerProvider;
use AccedeTercers; //facade
use AccedeVialer; //facade

class AccedeTestController extends Controller
{

	public function test($filter, AccedeTercersProvider $accedetercers, AccedeVialerProvider $accedevialer){ //con inyeccion
		//dd(request()->all());
		//dd($accedetercers);
		//$tercers=$accedetercers->getTercerByNIF($filter);
		//dd($tercers);
		//dd($filter);
		$vies=$accedevialer->searchViesByName($filter);

		if($vies) dd($vies);
		
		if($tercers){
			foreach($tercers as $tercer){
				$domicilios=$accedetercers->getDomicilisTercer($tercer->codigoTercero);
				$tercer->l_domicilio=$domicilios;
			}
			return $tercers;
		}
	}

	public function testFacade($filter){ //con facade
	
		$vies=AccedeVialer::searchViesByName($filter);
		if($vies) return $vies;

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
		$vies=accedevialer()->searchViesByName($filter);
		if($vies) return $vies;

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

