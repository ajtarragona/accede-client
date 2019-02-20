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


	protected function sendRequest($tobj,$cmd, $params=false,$apl="TER",$options=[]){
		$op=new AccedeOperation($apl,$tobj, $cmd,"2.0");
		//dd($op);
		$sec=new AccedeSecurity($this->options);
		//dd($sec);
		$request = new AccedeRequest($op,$sec,$params,false,false,$options);
		$request->setWSUrl($this->options->ws_url."?wsdl");
		//dd($request);
		return $request->send();
	}
}
