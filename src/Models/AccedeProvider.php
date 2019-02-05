<?php

namespace Ajtarragona\Accede\Models; 

use Ajtarragona\Accede\Models\AccedeObject;
use Ajtarragona\Accede\Models\Request as AccedeRequest;
use Ajtarragona\Accede\Models\Security as AccedeSecurity;
use Ajtarragona\Accede\Models\Operation as AccedeOperation;
use Ajtarragona\Accede\Models\Response as AccedeResponse;


class AccedeProvider {
	
	protected $options;
	
	public function __construct($options=array()) { 
		$opts=config('accede');
		if($options) $opts=array_merge($opts,$options);
		$this->options= json_decode(json_encode($opts), FALSE);
	}


	protected function sendRequest($tobj,$cmd, $params=false){
		$op=new AccedeOperation("TER",$tobj, $cmd,"2.0");
		$sec=new AccedeSecurity($this->options);
		
		$request= new AccedeRequest($op,$sec,$params);
		//dd($request);
		$request->setWSUrl($this->options->ws_url."?wsdl");
		//dd($request);
		return $request->send();
	}
}
