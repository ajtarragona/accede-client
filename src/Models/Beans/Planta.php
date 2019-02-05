<?php

	namespace Ajtarragona\Accede\Models\Beans; 
	use Ajtarragona\Accede\Models\AccedeObject;

	class Planta extends AccedeObject{
		protected static $SML_SINGLE = "planta";
		protected static $SML_LIST = "l_planta";


		public $codigoPlanta;
		public $nombrePlanta;
	}
