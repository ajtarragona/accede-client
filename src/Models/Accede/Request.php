<?php
namespace Ajtarragona\AccedeTercers\Models\Accede; 
use Ajtarragona\AccedeTercers\Models\Accede\AccedeObject;
use Ajtarragona\AccedeTercers\Models\Accede\Response as AccedeResponse;
use Ajtarragona\AccedeTercers\Models\Accede\Helpers\AccedeHelper;
use \SoapClient;


class Request  extends AccedeObject{
	
	const SERVICIO =  "servicioAlias";
	protected static $SML_SINGLE = "e";
	protected static $SML_LIST = "l_e";

	public $sec;
	public $ope;
	public $par;
	public $dat;
	private $wsurl;
	private $client;


	public function __construct($ope,$sec,$par=false,$dat=false,$wsurl=false){
		parent::__construct();
	
		$this->ope=$ope;
		$this->sec=$sec;
		$this->par = AccedeHelper::encodeArray($par);
		$this->dat=$dat;

		if($wsurl) $this->client = new SoapClient($wsurl);

	}

	public function setWSUrl($wsurl){
		$this->wsurl=$wsurl;
		$this->client = new SoapClient($this->wsurl);
	}


	
	public function send(){
		$sml=$this->toSML();
		//dump($sml);
		//$sml="<![CDATA[".$sml."]]>";
		
		//_dump(htmlentities($sml));
		//die();
		$params = array('in0'=>$sml);

		try{
			$ret=$this->client->__soapCall(self::SERVICIO, $params);
			$ret=AccedeHelper::decodeArray(AccedeHelper::fromSML($ret));
			//dd($ret);
			$response=AccedeResponse::parseArray($ret);
			//dd($response);
			//_dump($response);
			return $response;
		}catch(SoapFault $e){
			return false;
		}

	}



}