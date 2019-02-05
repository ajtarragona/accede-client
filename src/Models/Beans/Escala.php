<?php

	namespace Ajtarragona\Accede\Models\Beans; 
	use Ajtarragona\Accede\Models\AccedeObject;

	class Escala extends AccedeObject{
		protected static $SML_SINGLE = "escalera";
		protected static $SML_LIST = "l_escalera";


		public $codigoEscalera;
		public $nombreEscalera;
		
	}
	