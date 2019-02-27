<?php
    namespace Ajtarragona\Accede\Models\Beans; 
    use Ajtarragona\Accede\Models\AccedeObject;
    use AccedeTercers; //facade
    use Ajtarragona\Accede\Exceptions\AccedeNoResultsException;

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

        
       
        public function nombreCompleto($namelast=true){
            $cognoms=[];

            $ret="";

            if(isset($this->particula1) && $this->particula1) $cognoms[]=$this->particula1;
            if(isset($this->apellido1) && $this->apellido1) $cognoms[]=$this->apellido1;
            if(isset($this->particula2) && $this->particula2) $cognoms[]=$this->particula2;
            if(isset($this->apellido2) && $this->apellido2) $cognoms[]=$this->apellido2;

            if($namelast){
                if($cognoms) $ret=implode(" ", $cognoms).", ";
                $ret.=$this->nombre;
            }else{
                $ret=$this->nombre;
                if($cognoms) $ret.=" ".implode(" ", $cognoms);
            }
            return $ret;
        }

        public function setDomicilis($codigosDomicilio, $onlycodes=false){
            $domicilis=$this->getDomicilis($onlycodes);
            
            if($codigosDomicilio){
                if(!is_array($codigosDomicilio)) $codigosDomicilio=[$codigosDomicilio];

                foreach($codigosDomicilio as $codigoDomicilio){
                    $domicilis[]=[
                        "codigoDomicilio" => intval($codigoDomicilio),
                        "codigoTipoOcupacion" => Domicili::TIPO_OCUPACION_SECUNDARIA,
                    ];
                }
            }

            $this->l_domicilio=$domicilis;
        }
        

        public function removeDomicili($codigoDomicili, $onlycodes=false){
            $domicilis=$this->getDomicilis($onlycodes);
            $ret=[];

            foreach($domicilis as $domicili){
                if($domicili["codigoDomicilio"] != $codigoDomicili) $ret[]=$domicili;
            }

            $this->l_domicilio=$ret;
        }

        public function getDomicilis($onlycodes=false){
            try{
                $domicilis=AccedeTercers::getDomicilisTercer($this->codigoTercero);
                if($onlycodes){
                    $ret=[];
                    foreach($domicilis as $domicili){
                        $ret[]=[
                           "codigoDomicilio" => intval($domicili->codigoDomicilio),
                           "codigoTipoOcupacion" => intval($domicili->codigoTipoOcupacion)?intval($domicili->codigoTipoOcupacion):Domicili::TIPO_OCUPACION_SECUNDARIA,
                        ];

                    }
                    return $ret;
                }else{
                    return $domicilis;
                }
            }catch(AccedeNoResultsException $e){
                return [];
            }
        }

    }