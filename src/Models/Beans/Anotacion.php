<?php

	namespace Ajtarragona\Accede\Models\Beans; 
	use Ajtarragona\Accede\Models\AccedeObject;
	use Ajtarragona\Accede\Models\Helpers\AccedeHelper;

	class Anotacion extends AccedeObject{
		protected static $SML_SINGLE = "anotacion";
		protected static $SML_LIST = "l_anotacion";

		const ENTRADA = 'E';
		const SALIDA = 'S';

		
		public $numero;
		public $eje;
		public $fecha;
		public $hora;
		public $modalidad;
		public $asunto;
		public $tipo_t;
		public $tip;
		public $presencial;
		public $explicacion;
		public $sit;
		public $estado_anotacion;

		public $l_interesado;

		public function deEntrada(){
			return $this->tip== self::ENTRADA;
		}
		public function deSalida(){
			return $this->tip== self::SALIDA;
		}
		

		public function getMatricula(){
			return $this->eje."-".$this->numero."-".$this->tip;
		}

		public function getInteresados(){
			$ret=$this->l_interesado["interesado"];
			if(AccedeHelper::isAssoc($ret)){
				$ret=json_decode(json_encode($ret), FALSE);
				return [$ret];
			}else{
				$tmp=[];
				//dd($ret);
				foreach($ret as $r){
					$tmp[]=json_decode(json_encode(AccedeHelper::decodeArray($r)), FALSE); 
				}
				return $tmp;
			}
		}
		
	}
	