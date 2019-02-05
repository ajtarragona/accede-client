<?php

	namespace Ajtarragona\Accede\Models\Beans; 
	use Ajtarragona\Accede\Models\AccedeObject;

	class Portal extends AccedeObject{
		protected static $SML_SINGLE = "portal";
		protected static $SML_LIST = "l_portal";


		public $codigoPortal;
		public $nombrePortal;
	}
