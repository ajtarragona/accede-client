<?php

namespace Ajtarragona\Accede\Models; 

use Ajtarragona\Accede\Models\AccedeProvider;
use Ajtarragona\Accede\Models\AccedeObject;

use Ajtarragona\Accede\Models\Beans\Firmadoc\TipusDocument;
use Ajtarragona\Accede\Models\Beans\Firmadoc\TipusExpedient;
use Ajtarragona\Accede\Exceptions\AccedeNoResultsException;


class FirmadocProvider extends AccedeProvider{
	
	
	public function getAllTipusDocument($combo=false){
		$params=array(
			//"entCod" => 1
		);
		$response=$this->sendRequest("TDO","LST",$params,["apl"=>"GDOC"]);
		$items=TipusDocument::parseResponse($response);

		if($combo){
			$ret=[];
		    foreach($items as $item){
		        $ret[$item->tdoId] = $item->tdoCod . " - ". $item->tdoDes;
		    }
		}else{
			$ret=$items;
		}
		return $ret;
	}



	public function getTipusDocument($tdoCod){
		$params=array(
			"entCod" => 0,
			"tdoCod" => $tdoCod
		);
		$response=$this->sendRequest("TDO","LST",$params,["apl"=>"GDOC"]);
		return TipusDocument::parseSingle($response);

	}

	public function searchTipusDocument($tdoDes){
		$params=array(
			"entCod" => 0,
			"tdoDes" => $tdoDes
		);

		$response=$this->sendRequest("TDO","LST", $params, ["apl"=>"GDOC"]);
		return TipusDocument::parseSingle($response);

	}

	
	public function getAllTipusExpedient($combo=false){
		$params=array(
			//"entCod" => 1
		);
		$response=$this->sendRequest("TXP","LST",$params,["apl"=>"GDOC"]);
		$items=TipusExpedient::parseResponse($response);

		if($combo){
			$ret=[];
		    foreach($items as $item){
		        $ret[$item->lngTxpId] = $item->strTxpCod . " - ". $item->strTxpDes;
		    }
		}else{
			$ret=$items;
		}
		return $ret;
	}
	

	
}