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


class AccedeApiController extends Controller{

	//API



	private function tryWrap(callable  $function){
		try{
			return call_user_func($function);
		}catch(AccedeNoResultsException $e){
			return response()->json([], 200);
		}catch(AccedeErrorException $e){
			return response()->json([
				'error' => $e->getCode(),
				'message' => $e->getMessage()
			], 500);
		}

	}





	public function pais($codigoPais){
		return $this->tryWrap(function() use ($codigoPais){
			return response()->json(AccedeVialer::getPais(intval($codigoPais)));
		});
	}




	public function paisos($filter=false){
		return $this->tryWrap(function() use ($filter){
			
			if($filter){
				$paisos=AccedeVialer::searchPaisosByName($filter);
			}else{
				$paisos=AccedeVialer::getAllPaisos();
			}

			return response()->json($paisos);

		});
		
	}




	public function provincia($codigoProvincia){
		return $this->tryWrap(function() use ($codigoProvincia){
			return response()->json(AccedeVialer::getProvincia(intval($codigoProvincia)));
		});
	}
	



	public function provincies($filter=false){
		return $this->tryWrap(function() use ($filter){
			if($filter){
				$provincies=AccedeVialer::searchProvinciesByName($filter);
			}else{
				$provincies=AccedeVialer::getAllProvincies();
			}

			return response()->json($provincies);
		});
		
	}





	public function municipi($codigoProvincia,$codigoMunicipio){
		return $this->tryWrap(function() use ($codigoProvincia,$codigoMunicipio){
			return response()->json(AccedeVialer::getMunicipi(intval($codigoMunicipio),intval($codigoProvincia)));
		});
	}




	public function municipis($codigoProvincia,$filter=false){
		return $this->tryWrap(function() use ($codigoProvincia,$filter){
			if($filter){
				$municipis=AccedeVialer::searchMunicipisByName($filter,intval($codigoProvincia));
			}else{
				$municipis=AccedeVialer::getAllMunicipis(intval($codigoProvincia));
			}
			return response()->json($municipis);
		});
		
	}





	public function via($codigoProvincia,$codigoMunicipio,$codigoIneVia){
		return $this->tryWrap(function() use ($codigoProvincia,$codigoMunicipio,$codigoIneVia){
			//dd($codigoIneVia);
			return response()->json(AccedeVialer::getVia(intval($codigoIneVia),intval($codigoProvincia),intval($codigoMunicipio)));
		});
	}





	public function vies($codigoProvincia,$codigoMunicipio,$filter=false){
		return $this->tryWrap(function() use ($codigoProvincia,$codigoMunicipio,$filter){
			if($filter){
				$vies=AccedeVialer::searchViesByName($filter,intval($codigoProvincia),intval($codigoMunicipio));
			}else{
				$vies=AccedeVialer::getAllVies(intval($codigoProvincia),intval($codigoMunicipio));
			}
			return response()->json($vies);
		});
		
	}








	public function codificadors($codigoIneVia, $numero=false, $nombrePlanta=false){
		return $this->tryWrap(function() use ($codigoIneVia,$numero,$nombrePlanta){
			$codificadors=AccedeVialer::getCodificadorsVia($codigoIneVia,$numero,$nombrePlanta);
			return response()->json($codificadors);
		});
	}






	public function viesCombo($codigoProvincia,$codigoMunicipio, Request $request){
		return $this->tryWrap(function() use ($codigoProvincia,$codigoMunicipio, $request){
			
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

		});
		
	}





	public function numeros($codigoIneVia){
		return $this->tryWrap(function() use ($codigoIneVia){
			$numeros=AccedeVialer::getNumerosVia($codigoIneVia);
			return response()->json($numeros);
		});
	}





	public function numerosCombo($codigoIneVia){
		return $this->tryWrap(function() use ($codigoIneVia){
			$items=AccedeVialer::getNumerosVia($codigoIneVia);
				
			$ret=[];
		    foreach($items as $item){
		        $ret[] = ["value"=>$item, "name"=>$item];
		    }
		    return response()->json($ret);
		});
	}
	



	
	public function lletres($codigoIneVia, $numero=false){
		return $this->tryWrap(function() use ($codigoIneVia, $numero){
			$lletres=AccedeVialer::getLletresVia($codigoIneVia, $numero);
			return response()->json($lletres);
		});
	}





	public function lletresCombo($codigoIneVia, $numero=false){
		return $this->tryWrap(function() use ($codigoIneVia, $numero){
			$items=AccedeVialer::getLletresVia($codigoIneVia, $numero);
			//dd($items);
			$ret=[];
		    foreach($items as $item){
		        $ret[] = ["value"=>$item, "name"=>$item];
		    }
		    return response()->json($ret);
		});
	}

	
	



	public function escales($codigoIneVia, $numero=false){
		return $this->tryWrap(function() use ($codigoIneVia, $numero){
			$escales=AccedeVialer::getEscalesVia($codigoIneVia, $numero);
			return response()->json($escales);
		});
	}





	public function escalesCombo($codigoIneVia, $numero=false){
		return $this->tryWrap(function() use ($codigoIneVia, $numero){
			$items=AccedeVialer::getEscalesVia($codigoIneVia, $numero);
			$ret=[];
		    foreach($items as $item){
		        $ret[] = ["value"=>$item["codigoEscalera"], "name"=>$item["nombreEscalera"] ];
		    }
		    return response()->json($ret);
		});
	}




	

	public function blocs($codigoIneVia){
		return $this->tryWrap(function() use ($codigoIneVia){
			$blocs=AccedeVialer::getBlocsVia($codigoIneVia);
			return response()->json($blocs);
		});
	}





	public function blocsCombo($codigoIneVia){
		return $this->tryWrap(function() use ($codigoIneVia){
			$items=AccedeVialer::getBlocsVia($codigoIneVia);
			$ret=[];
		    foreach($items as $item){
		        $ret[] = ["value"=>$item["codigoBloque"], "name"=>$item["nombreBloque"]];
		    }
		    return response()->json($ret);
		});
	}





	public function plantes($codigoIneVia, $numero=false){
		return $this->tryWrap(function() use ($codigoIneVia, $numero){
			$plantes=AccedeVialer::getPlantesVia($codigoIneVia, $numero);
			return response()->json($plantes);
		});
	}






	public function plantesCombo($codigoIneVia, $numero=false){
		return $this->tryWrap(function() use ($codigoIneVia, $numero){
			$items=AccedeVialer::getPlantesVia($codigoIneVia, $numero);
			//dd($items);
			$ret=[];
		    foreach($items as $item){
		        $ret[] = ["value"=>$item["codigoPlanta"], "name"=>$item["nombrePlanta"]];
		    }
		    return response()->json($ret);
		});
	}


	

	public function codispostals($codigoIneVia, $numero=false){
		return $this->tryWrap(function() use ($codigoIneVia, $numero){
			$cpostals=AccedeVialer::getCodisPostalsVia($codigoIneVia, $numero);
			return response()->json($cpostals);
		});
	}

	


	public function codispostalsCombo($codigoIneVia, $numero=false){
		return $this->tryWrap(function() use ($codigoIneVia, $numero){
			$items=AccedeVialer::getCodisPostalsVia($codigoIneVia, $numero);
			$ret=[];
		    foreach($items as $item){
		        $ret[] = ["value"=>$item, "name"=>$item];
		    }
		    return response()->json($ret);
		});
	}





	public function portes($codigoIneVia, $numero=false, $nombrePlanta=false){
		return $this->tryWrap(function() use ($codigoIneVia, $numero, $nombrePlanta){
			$portes=AccedeVialer::getPortesVia($codigoIneVia, $numero, $nombrePlanta);
			return response()->json($portes);
		});
	}





	public function portesCombo($codigoIneVia, $numero=false, $nombrePlanta=false){
		return $this->tryWrap(function() use ($codigoIneVia, $numero, $nombrePlanta){
			$items=AccedeVialer::getPortesVia($codigoIneVia, $numero, $nombrePlanta);
			$ret=[];
		    foreach($items as $item){
		        $ret[] = ["value"=>$item["codigoPuerta"], "name"=>$item["nombrePuerta"]];
		    }
		    return response()->json($ret);
		});
	}
	
}
