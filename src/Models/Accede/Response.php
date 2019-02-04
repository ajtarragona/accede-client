<?php
	namespace Ajtarragona\AccedeTercers\Models\Accede; 

	use Ajtarragona\AccedeTercers\Models\Accede\AccedeObject;

	class Response extends AccedeObject{
		protected static $SML_SINGLE = "s";
		protected static $SML_LIST = "l_s";
		
		public $sec;
		public $res;
		public $par;

	}