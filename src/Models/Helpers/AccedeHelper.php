<?php

namespace Ajtarragona\Accede\Models\Helpers; 
use Ajtarragona\Accede\Models\AccedeObject;

class AccedeHelper{

	public static function fromSML($sml){
		$arr= json_decode(json_encode(simplexml_load_string($sml)), true);
		return json_decode(json_encode($arr), FALSE);

	}


	public static function isAssoc($arr)
	{
	    if (array() === $arr) return false;
	    return array_keys($arr) !== range(0, count($arr) - 1);
	}


	public static function toSML($data, $rootNodeName = 'data',$tab=0)
	{
		
		

		$xml="";
		$tabs=str_repeat("\t",$tab);
		$tabs1=str_repeat("\t",$tab+1);

		$xml.= "$tabs<$rootNodeName>\n";
		

		// loop through the data passed in.
		foreach($data as $key => $value)
		{
			/*_dump("KEY:".$key);
			_dump("VALUE:");
			_dump($value);*/

			if(isset($value) && ((is_array($value)) || !empty($value) || $value===0) && !in_array($key, explode(",", AccedeObject::EXCLUDED_SML_KEYS) )){
				//_dump("ENTRO");
				// no numeric keys in our xml please!
				if (is_numeric($key))
				{
					// make string key...
					$key = "node_". $key;
				}
	 
				// replace anything not alpha numeric
				//$key = preg_replace('/[^a-z]/i', '', $key);
	 
				// if there is another array found recrusively call this function
				if (is_array($value) || is_object($value))
				{
					if(is_object($value) || self::isAssoc($value)){
						// recrusive call.
						$xml.=self::toSML($value, $key,($tab+1));
					}else{
						$xml.= "$tabs1<$key>".implode(",",$value)."</$key>\n";
					}
				}
				else 
				{
					// add single node.
	                //$value = self::accedeEncodedValue($value);
					$xml.= "$tabs1<$key>$value</$key>\n";
				}
			}
 
		}
		$xml.= "$tabs</$rootNodeName>\n";

		return $xml;
	}


	public static function is_date($in) {
		return (boolean) strtotime($in);
	}
	
	public static function is_UTCDate($in) {
		
		if(strlen($in)!=14) return false;

		
		for($i=0; $i<strlen($in); $i++){
		 	if(!is_numeric($in[$i])) return false;
		}
		return true;
	}



	public static function accedeEncodedValue($value, $encode=true){
		$ret=$value;
		//dump($value);
		if(self::is_date($value)){
			$ret = self::getFechaUTC($value);
		}

		if(is_int($value) || is_float($value)){
			$ret = $value;
		}else{
			$ret = $encode?base64_encode($value):$value;
		}
		
		return $ret;
	}
	

	public static function accedeDecodedValue($value){
		$ret=$value;
		//return $ret;
		if(self::is_base64($value)){
        
        	$ret=utf8_encode(base64_decode($value));
        
        }else if(self::is_UTCDate($value)){
        	$ret=self::getDateFromUTC($value);
        }
		
		return $ret;
	}



	public static function decodeArray($data){
		$ret=array();

		foreach($data as $key => $value)
		{
			if(isset($value) && (!empty($value) || $value===0)){
				
				// if there is another array found recrusively call this function
				if (is_array($value) || is_object($value))
				{
					if(is_object($value) || self::isAssoc($value)){
						// recrusive call.
						$ret[$key]=self::decodeArray($value);
					}else{
						//_dump($key);
						//_dump($value);
						//$ret[$key]= implode(",",$value);
						$ret[$key]= $value;//implode(",",$value);
					}
				}
				else 
				{
					// add single node.
					
	                $ret[$key] = self::accedeDecodedValue($value);
	               
	                //$ret[$key]=$value;
				}
			}
 
		}
		return $ret;
	}


	public static function encodeArray($data,$options=[]){
		$ret=array();

		foreach($data as $key => $value)
		{
			if(isset($value) && (!empty($value) || $value===0)){
				if (is_numeric($key))
				{
					// make string key...
					$key = "node_". $key;
				}
	 
				// if there is another array found recrusively call this function
				if (is_array($value) || is_object($value))
				{
					if(is_object($value) || self::isAssoc($value)){
						// recrusive call.
						$ret[$key]=self::encodeArray($value,$options);
					}else{
						$ret[$key]= implode(",",$value);
					}
				}
				else 
				{
					
					// add single node.
					//dd($options);
					//dd(isset($options["excluded"]) && in_array($key, $options["excluded"]));
					$excluded=isset($options["excluded"]) && is_array($options["excluded"]) && in_array($key, $options["excluded"]);
					//dd($excluded);
	                $ret[$key] = self::accedeEncodedValue($value, !$excluded);
	                
				}
			}
 
		}
		return $ret;
	}


	public static function getFechaActual(){
		return self::getFechaUTC();

	}

	public static function getFechaUTC($date=false){
		$format= "YmdHis";

		//em mes empieza en 0
		if($date){
			return date($format,strtotime($date." -1 months"));
		}else{
			return date($format,strtotime("-1 months"));
		}
		

	}


	public static function getDateFromUTC($utc){
		$format= "YmdHis";
		$datearr=date_parse_from_format($format, $utc);
		
		/*_dump($utc);
		_dump($datearr);*/

		$rformatted= 
		implode("/", array( 
			str_pad($datearr["day"],2,"0", STR_PAD_LEFT),
			str_pad($datearr["month"],2,"0", STR_PAD_LEFT), 
			str_pad($datearr["year"],2,"0", STR_PAD_LEFT) 
		))
		." ".
		implode(":", array(
			str_pad($datearr["hour"],2,"0", STR_PAD_LEFT), 
			str_pad($datearr["minute"],2,"0", STR_PAD_LEFT), 
			str_pad($datearr["second"],2,"0", STR_PAD_LEFT)
		)
		);
		//_dump($rformatted);
		return $rformatted;
	}

	public static function randomLong($length, $keyspace = '0123456789') {
	    $str = '';
	    $max = mb_strlen($keyspace, '8bit') - 1;
	    if ($max < 1) {
	        throw new Exception('$keyspace must be at least two characters long');
	    }
	    for ($i = 0; $i < $length; ++$i) {
	        $str .= $keyspace[random_int(0, $max)];
	    }
	    return $str;
	}

	/*public static function randomLong($length = 18) {
	    $characters = '0123456789';
	    $string = '';    

	    for ($p = 0; $p < $length; $p++) {
	        $string .= $characters[mt_rand(0, strlen($characters)-1)];
	    }

	    return $string;
	}*/

	public static function generateNonce() {


		return mt_rand(-1*mt_getrandmax(), mt_getrandmax());
		
		//dd($ret);
		//$ret=bin2hex(openssl_random_pseudo_bytes(16));
		/*return $ret;
		//dd($ret);

		$length=rand(18,19);
		$sign=rand(0,1)?"":"-";

		$nonce=$sign. self::randomLong($length);
		return $nonce;*/
	}

	public static function getSHA512Base64($data){
		return base64_encode(hash('sha512', $data, true));
	}

	public static function getSHA1Base64($data){

		return base64_encode(sha1($data,true));
	}


	public static function is_base64($data){
		if(is_numeric($data)) return false;
		//_dump($data);
		//if(!base64_decode($data)) return false;
		//_dump("decoded:".base64_decode($data));
		//_dump("encoded:".base64_encode(base64_decode($data)));

		//quito saltos de linea
		$data= str_replace(array("\r", "\n"), '', $data);

		return ( base64_encode(base64_decode($data)) === $data);
	}

}