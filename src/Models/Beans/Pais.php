<?php

	namespace Ajtarragona\Accede\Models\Beans; 
	use Ajtarragona\Accede\Models\AccedeObject;

	class Pais extends AccedeObject{
		protected static $SML_SINGLE = "pais";
		protected static $SML_LIST = "l_pais";


		public $codigoPais;
		public $nombrePais;
		public $comunitarioPais;
	}
	