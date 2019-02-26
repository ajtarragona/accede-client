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
        public $particula1;
        public $particula2;
        public $apellido1;
        public $apellido2;
        public $telefono;
        public $usuarioAlta;
        public $fechaAlta;
        public $situacionTercero;

        
       
        public function nombreCompleto(){
            $ret=[];

            if(isset($this->nombre) && $this->nombre) $ret[]=$this->nombre;
            if(isset($this->particula1) && $this->particula1) $ret[]=$this->particula1;
            if(isset($this->apellido1) && $this->apellido1) $ret[]=$this->apellido1;
            if(isset($this->particula2) && $this->particula2) $ret[]=$this->particula2;
            if(isset($this->apellido2) && $this->apellido2) $ret[]=$this->apellido2;

            return implode(" ", $ret);
        }


    }