<?php

	namespace Ajtarragona\Accede\Models\Beans; 
	use Ajtarragona\Accede\Models\AccedeObject;

	class TipusDocument extends AccedeObject{
		protected static $SML_SINGLE = "tipoDocumento";
		protected static $SML_LIST = "l_tipoDocumento";


		public $codigoTipoDocumento;
		public $nombreTipoDocumento;
		public $codigoIneTipoDocumento;
		public $normalizadoTipoDocumento;
		public $personaFisica;
		
	}
