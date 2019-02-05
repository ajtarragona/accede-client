<?php

	namespace Ajtarragona\Accede\Models\Beans; 
	use Ajtarragona\Accede\Models\AccedeObject;

	class Provincia extends AccedeObject{
		protected static $SML_SINGLE = "provincia";
		protected static $SML_LIST = "l_provincia";


		public $codigoProvincia;
		public $nombreProvincia;
		public $codigoAutonomia;
		public $nombreAutonomia;
	}
	