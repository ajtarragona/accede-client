<?php
	namespace Ajtarragona\Accede\Models; 

	use Ajtarragona\Accede\Models\AccedeObject;

	class Response extends AccedeObject{
		protected static $SML_SINGLE = "s";
		protected static $SML_LIST = "l_s";
		
		public $sec;
		public $res;
		public $par;

	}