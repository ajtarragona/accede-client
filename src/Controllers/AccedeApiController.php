<?php

namespace Ajtarragona\Accede\Controllers; 

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use Ajtarragona\Accede\Exceptions\AccedeErrorException;
use Ajtarragona\Accede\Exceptions\AccedeNoResultsException;


class AccedeApiController extends Controller{

	protected function tryWrap(callable  $function){
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
}