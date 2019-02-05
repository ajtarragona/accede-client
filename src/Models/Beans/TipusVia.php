<?php

	namespace Ajtarragona\Accede\Models\Beans; 
	use Ajtarragona\Accede\Models\AccedeObject;

	class TipusVia extends AccedeObject{
		protected static $SML_SINGLE = "tipoVia";
		protected static $SML_LIST = "l_tipoVia";


		public $codigoTipoVia;
		public $codigoIneTipoVia;
		public $nombreTipoVia;
		public $sufijoTipoVia;
	}
	