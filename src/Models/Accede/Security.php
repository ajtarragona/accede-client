<?php 
	namespace Ajtarragona\AccedeTercers\Models\Accede; 
	use Ajtarragona\AccedeTercers\Models\Accede\AccedeObject;
	use Ajtarragona\AccedeTercers\Models\Accede\Helpers\AccedeHelper;
	
	class Security extends AccedeObject{
		
		protected static $SML_SINGLE = "sec";
		protected static $SML_LIST = "l_sec";


		public $cli;
		public $org;
		//public $ent;
		public $usu;
		public $pwd;

		public $fecha;
		public $nonce;
		public $token;
		//public $tokensha1;
	//	public $kkk;

		public function __construct($options){
			parent::__construct();
			
			$this->cli = $options->ws_sec_cli;
			$this->org = (int) $options->ws_sec_org;
			//$this->ent = (int) $options->ws_sec_ent;
			$this->usu = $options->ws_sec_user;
			$this->pwd = $options->ws_sec_pwd;

			$this->fecha=AccedeHelper::getFechaActual();
		
			$this->nonce = AccedeHelper::generateNonce();
			
			$clavePublica= $options->token_key;
			//_dump($this->nonce . $this->fecha . $clavePublica);
			$this->token = AccedeHelper::getSHA512Base64($this->nonce . $this->fecha . $clavePublica);
			//$this->tokensha1 = AccedeHelper::getSHA1Base64($this->nonce . $this->fecha . $clavePublica);
		}

				
	}