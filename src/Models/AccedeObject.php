<?php

namespace Ajtarragona\Accede\Models; 
use Ajtarragona\Accede\Models\Helpers\AccedeHelper;


class AccedeObject{

	const EXCLUDED_SML_KEYS = "SMLNAME"; //comma separated
	const ACCEDE_BOOL_TRUE = -1;
	const ACCEDE_BOOL_FALSE = 0;
	
	protected static $SML_SINGLE = "object";
	protected static $SML_LIST = "l_object";


	protected $SMLNAME;

    
	public function __construct(){
		$classname=get_called_class();
    	$this->SMLNAME = $classname::$SML_SINGLE;
		
	}


	public function fromSML($sml){
		$array=AccedeHelper::fromSML($sml);
		return $this->fromArray($array);
	}

	public static function parseArray($array){
		$classname=get_called_class();
    	$ret=new $classname;
    	foreach($array as $key=>$value){
			$ret->$key=$value;
    	}
    	//_dump($ret);
    	return $ret;
	}

	public function fromArray($array){
		//_dump($array);
    	foreach($array as $key=>$value){
    		$this->$key=$value;
    	}
    }

	public function toSML(){
		$ret=AccedeHelper::toSML($this,$this->SMLNAME);
		
		return $ret;


	}
    

    public static function parseCreate($response){
         if(isset($response->res["exito"]) && $response->res["exito"]==self::ACCEDE_BOOL_TRUE){
            return reset($response->par);
         }else{
            return false;
         }
    }

	public static function parseResponse($response, $single=false){
        $ret=false;
        $classname=get_called_class();
        //dump($classname);

        if(isset($response->par[$classname::$SML_LIST])){
            //dd($response->par);
            if(isset($response->par[$classname::$SML_LIST][$classname::$SML_SINGLE])){
                if(AccedeHelper::isAssoc($response->par[$classname::$SML_LIST][$classname::$SML_SINGLE])){
                 //if($single){
                    $ret=array();
                    $object=$response->par[$classname::$SML_LIST][$classname::$SML_SINGLE];
                    $ret[]=self::parseArray($object);
                }else{
                    $ret=array();
                    $objects=$response->par[$classname::$SML_LIST][$classname::$SML_SINGLE];
                    if($objects){
                        foreach($objects as $object){
                            $ret[]=self::parseArray(AccedeHelper::decodeArray($object));
                        }
                    }
                }
            }
        }
        // dump($ret);
        // dump(json_encode($ret));
        // dd(json_last_error_msg());
        return $ret;
    }

 
}