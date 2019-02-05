<?php
    namespace Ajtarragona\Accede\Models\Beans; 
    use Ajtarragona\Accede\Models\AccedeObject;
        
    class Tercer extends AccedeObject  {
        protected static $SML_SINGLE = "tercero";
    	protected static $SML_LIST = "l_tercero";

        public $codigoTercero;
        public $codigoTipoDocumento;
        public $nombreTipoDocumento;
        public $documento;
        public $nombre;
        public $apellido1;
        public $apellido2;
        public $telefono;
        public $usuarioAlta;
        public $fechaAlta;
        public $situacionTercero;

        
       



    }