<?php

namespace Ajtarragona\Accede\Models\Beans\Firmadoc; 

use Ajtarragona\Accede\Models\AccedeObject;

class TipusExpedient extends AccedeObject{
	protected static $SML_SINGLE = "txp";
	protected static $SML_LIST = "l_txp";


	public $lngTxpId;
	public $strTxpCod;
	public $strTxpDes;
	
}



