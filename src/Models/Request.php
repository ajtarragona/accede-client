<?php
namespace Ajtarragona\Accede\Models; 
use Ajtarragona\Accede\Models\AccedeObject;
use Ajtarragona\Accede\Models\Response as AccedeResponse;
use Ajtarragona\Accede\Models\Helpers\AccedeHelper;
use \SoapClient;
use \SoapFault;
use Illuminate\Support\Facades\Log;


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
	protected $options=["excluded"=>false, "included"=>false];


	public function __construct($ope,$sec,$par=false,$dat=false,$wsurl=false,$options=[]){
		parent::__construct();
		
		$this->options=array_merge($this->options,$options);

		$this->ope=$ope;
		$this->sec=$sec;
		//dd($this);
		//if($par && count($par)>0) 
		$this->par = AccedeHelper::encodeArray($par, $this->options);
		//dd($this->par);
		$this->dat=$dat;
		try{
			if($wsurl) $this->client = new SoapClient($wsurl, ['exceptions' => true]);
		}catch(SoapFault $e){
			return false;
		}

	}

	public function setWSUrl($wsurl){
		try{
			$this->wsurl=$wsurl;
			$this->client = new SoapClient($this->wsurl, ['exceptions' => true]);
		}catch(SoapFault $e){
			return false;
		}
	}


	
	public function send(){
		$sml=$this->toSML();
		//dd($sml);
		if(config("accede.debug")) Log::debug('Accede Request: \n'.$sml);
		//$sml="<![CDATA[".$sml."]]>";
		
		//_dump(htmlentities($sml));
		//die();
		$params = array('in0'=>$sml);

		try{
			if(!$this->client){
				return AccedeResponse::errorReponse(1,"Error de connexió al WS ACCEDE");
			}

			$ret=$this->client->__soapCall(self::SERVICIO, $params);
			
			if(config("accede.debug")) Log::debug('Accede Response: \n'.$ret);

			$ret=AccedeHelper::decodeArray(AccedeHelper::fromSML($ret));
			//dd($ret);
			$response=AccedeResponse::parseArray($ret);
			//dd($response);
			//_dump($response);
			return $response;
		}catch(SoapFault $e){
			return AccedeResponse::errorReponse(1,"Error de connexió al WS ACCEDE");
		}

	}



}