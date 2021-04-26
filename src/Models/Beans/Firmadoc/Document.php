<?php

namespace Ajtarragona\Accede\Models\Beans\Firmadoc; 

use Ajtarragona\Accede\Models\AccedeObject;

class Document extends AccedeObject{
	protected static $SML_SINGLE = "idx";
	protected static $SML_LIST = "l_idx";

    public $binDocumento;
	public $strPathDocumento;
	public $strNombreDocumento;
	public $strTipoDocumento;

	public $strExpTxp;
	public $strExpCod;
	public $lngExpAnn;

    public $lngExpId;

	
	
}


