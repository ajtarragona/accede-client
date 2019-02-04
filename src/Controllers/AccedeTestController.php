<?php

namespace Ajtarragona\AccedeTercers\Controllers; 

use App\Http\Controllers\Controller;
use Ajtarragona\AccedeTercers\Models\Accede\AccedeTercersProvider;


class AccedeTestController extends Controller
{

	public function test($filter, AccedeTercersProvider $accede){
		/*echo 'Hello !';
		$key=config('accede-tercers.token_key');

		dump($key);

		$accedeoptions=config('accede-tercers');
		dump($accedeoptions);
*/
		$tercers=$accede->searchTercersByFullName($filter);
		//dd($tercers);
		
		if($tercers){
			foreach($tercers as $tercer){
				$domicilios=$accede->getDomicilisTercer($tercer->codigoTercero);
				$tercer->l_domicilio=$domicilios;
			}
		}
		return $tercers;
	}
}
