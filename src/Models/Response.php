<?php
	namespace Ajtarragona\Accede\Models; 

	use Ajtarragona\Accede\Models\AccedeObject;
	use Ajtarragona\Accede\Exceptions\AccedeException;

	class Response extends AccedeObject{
		protected static $SML_SINGLE = "s";
		protected static $SML_LIST = "l_s";
		
		public $sec;
		public $res;
		public $par;



		public function success(){
			if(isset($this->res["exito"]) && $this->res["exito"]==self::ACCEDE_BOOL_TRUE ){
				return true;
			}else{
				$msg=isset($this->res['codigo'])?$this->res['codigo']:"";
				$msg.=isset($this->res['desc'])?(": ".$this->res['desc']):"";
	            throw new AccedeException('Error '.$msg);

			}
		}
		
		public function hasResults($list,$single){
			 //$classname=get_called_class();
			// dump($classname);
			 $ret=(isset($this->par[$list]) && isset($this->par[$list][$single]));
			 if($ret){
			 	return true;
			 }else{
			 	throw new AccedeException('No results');
			 }
		}

	}