<?php

namespace Ajtarragona\Accede\Models\Beans\Firmadoc; 

use Ajtarragona\Accede\Models\AccedeObject;

class Expedient extends AccedeObject{
	protected static $SML_SINGLE = "expediente";
	protected static $SML_LIST = "l_expedientes";


	public $lngIdx;
	public $exp;
	public $strInfoId;

	public $l_idxs;
	public $idx;
	
}


