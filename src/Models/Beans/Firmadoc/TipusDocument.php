<?php

namespace Ajtarragona\Accede\Models\Beans\Firmadoc; 

use Ajtarragona\Accede\Models\AccedeObject;

class TipusDocument extends AccedeObject{
	protected static $SML_SINGLE = "tdo";
	protected static $SML_LIST = "l_tdo";


	public $tdoId;
	public $tdoCod;
	public $tdoDes;
	
}


