<?php

	namespace Ajtarragona\Accede\Models\Beans; 
	use Ajtarragona\Accede\Models\AccedeObject;

	class Municipi extends AccedeObject{
		protected static $SML_SINGLE = "municipio";
		protected static $SML_LIST = "l_municipio";


		public $codigoMunicipio;
		public $nombreMunicipio;
		public $nombreLargoMunicipio;
		public $codigoComarca;
		public $nombreComarca;
		public $codigoPartidoJudicial;
		public $nombrePartidoJudicial;
		public $capitalMunicipio;
	}
	