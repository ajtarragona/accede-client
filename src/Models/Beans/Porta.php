<?php

	namespace Ajtarragona\Accede\Models\Beans; 
	use Ajtarragona\Accede\Models\AccedeObject;

	class Porta extends AccedeObject{
		protected static $SML_SINGLE = "puerta";
		protected static $SML_LIST = "l_puerta";


		public $codigoPuerta;
		public $nombrePuerta;
	}
