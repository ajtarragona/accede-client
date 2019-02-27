<?php

namespace Ajtarragona\Accede\Controllers; 

use Ajtarragona\Accede\Models\Beans\Domicili;
use Ajtarragona\Accede\Models\AccedeTercersProvider;
use Ajtarragona\Accede\Models\AccedeVialerProvider;
use Ajtarragona\Accede\Models\AccedeRegistreProvider;
use Illuminate\Http\Request;

use AccedeTercers; //facade
use AccedeVialer; //facade
use AccedeRegistre; //facade
use Ajtarragona\Accede\Controllers\AccedeApiController as Controller;
use Ajtarragona\Accede\Exceptions\AccedeErrorException;
use Ajtarragona\Accede\Exceptions\AccedeNoResultsException;
use \Artisan;


class AccedeTercersApiController extends Controller{

	//API

	public function tercers($filter=false){
		return $this->tryWrap(function() use ($filter){
			if($filter){
				$tercers=AccedeTercers::searchTercers($filter);
			}
			return response()->json($tercers);
		});
		
	}

	public function tercersCombo(Request $request){
		return $this->tryWrap(function() use ($request){
			$ret=[];
			if($request->term){
				$tercers=AccedeTercers::searchTercers($request->term);

			    foreach($tercers as $tercer){
			        $ret[] = ["value"=>$tercer->codigoTercero, "name"=>$tercer->documento." | ".$tercer->nombreCompleto()];
			    }
			}
			return response()->json($ret);
		});


	}




	
}
