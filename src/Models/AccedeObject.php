<?php

namespace Ajtarragona\Accede\Models; 
use Ajtarragona\Accede\Models\Helpers\AccedeHelper;
use Ajtarragona\Accede\Exceptions\AccedeException;
use Illuminate\Database\Eloquent\Model;


class AccedeObject {

	const EXCLUDED_SML_KEYS = "SMLNAME"; //comma separated
	const ACCEDE_BOOL_TRUE = -1;
	const ACCEDE_BOOL_FALSE = 0;
	
	protected static $SML_SINGLE = "object";
	protected static $SML_LIST = "l_object";


    protected $SMLNAME;

    //protected $hidden = ['SMLNAME'];
    
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

    public function __toString(){
       $ret=[];
       foreach($this as $key=>$value){
            if(!in_array($key, explode(",", self::EXCLUDED_SML_KEYS) ) ) {
                $ret[$key]=$value;
             }

       }
       return json_encode($ret);
       //return json_encode($this);
    }
    

    public static function parseCreate($response, $return=false){
         if($response->success()){
            if($return)
                if(isset($response->par[$return])) return $response->par[$return];
                else return reset($response->par); 
            else 
                return reset($response->par); //devuelve primer elemento
         }else{
            return false;
         }
    }

    public static function parseResponse($response, $single=false){
        //dump($response);
        $ret=false;
        $classname=get_called_class();
        //dump($classname);
        if($response->success()){
            if($response->hasResults($classname::$SML_LIST,$classname::$SML_SINGLE)){
                //dd($response->par);
                //if(isset($response->par[$classname::$SML_LIST][$classname::$SML_SINGLE])){
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
               // }
            }
           
            // dump(json_encode($ret));
            // dd(json_last_error_msg());
            if($ret && $single) return $ret[0];
            else return $ret;
        }
    }


	public static function parseSingle($response, $single=false){
        return self::parseResponse($response,true);
    }

 
}