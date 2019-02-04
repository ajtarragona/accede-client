<?php

	namespace Ajtarragona\AccedeTercers\Models\Accede; 	
	use Ajtarragona\AccedeTercers\Models\Accede\AccedeObject;

	class Operation extends AccedeObject{

		protected static $SML_SINGLE = "ope";
		protected static $SML_LIST = "l_ope";

		public $apl;
		public $tobj;
		public $cmd;
		public $ver;


		public function __construct($apl, $tobj, $cmd, $ver){
			parent::__construct();
			
			$this->apl=$apl;
			$this->tobj=$tobj;
			$this->cmd=$cmd;
			$this->ver=$ver;

		}
	}