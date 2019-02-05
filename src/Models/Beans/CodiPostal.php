<?php

	namespace Ajtarragona\Accede\Models\Beans; 
	use Ajtarragona\Accede\Models\AccedeObject;

	class CodiPostal extends AccedeObject{
		protected static $SML_SINGLE = "codigoPostal";
		protected static $SML_LIST = "l_codigoPostal";


		public $codigoPostal;
		public $codigoPostalPorDefecto;
		
	}
	