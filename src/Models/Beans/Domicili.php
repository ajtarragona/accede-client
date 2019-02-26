<?php

	namespace Ajtarragona\Accede\Models\Beans; 
	use Ajtarragona\Accede\Models\AccedeObject;

	class Domicili extends AccedeObject{
		protected static $SML_SINGLE = "domicilio";
		protected static $SML_LIST = "l_domicilio";

		
		const TIPO_NUMERACION_NONE = 0;
		const TIPO_NUMERACION_IMPARELL = 1;
		const TIPO_NUMERACION_PARELL = 2;
		
		const TIPO_VIVIENDA_FAMILIAR = 1;
		const TIPO_VIVIENDA_COLECTIVA = 2;




		public $codigoDomicilio;
	    public $codigoDireccionSuelo;
	    public $codigoTipoOcupacion;
	    public $nombreTipoOcupacion;
	    public $normalizadoDomicilio;
	    public $codigoPais;
		public $nombrePais;
		public $codigoProvincia;
	    public $nombreProvincia;
	    public $codigoMunicipio;
	    public $nombreMunicipio;
	    public $codigoEntidadSingular;
	    public $codigoIneEntidadSingular;
	    public $nombreEntidadSingular;
	    public $codigoNucleo;
	    public $codigoIneNucleo;
	    public $nombreNucleo;
	    public $distrito;
	    public $seccion;
	    public $letraSeccion;
	    public $letraDesde;
	    public $letraHasta;
	    public $codigoTipoVia;
	    public $codigoIneTipoVia;
	    public $nombreTipoVia;
	    public $codigoVia;
	    public $codigoIneVia;
	    public $nombreVia;
	    public $numeroDesde;
	    public $numeroHasta;
	    public $codigoPlanta;
	    public $nombrePlanta;
	    public $codigoPuerta;
	    public $codigoPostal;
	    public $codigoTipoVivienda;
	    public $nombreTipoVivienda;
	    public $codigoTipoNumeracion;
	    public $nombreTipoNumeracion;
	    public $situacionTramo;
	    public $cadenaDomicilio;
	    public $cadenaDomicilioCompleta;
	    public $usuarioAlta;
	    public $fechaAlta;
	    public $codigoBloque;
	    public $codigoEscalera;
	    public $nombreEscalera;
	    public $kilometro;
		

		public function getNumero(){
			$ret=[];
			if(isset($this->numeroDesde) && $this->numeroDesde) $ret[]=$this->numeroDesde;
			if(isset($this->numeroHasta) && $this->numeroHasta)  $ret[]=$this->numeroHasta;
			if($ret) return implode("-",$ret);
			else return "";
		}


		public function getLletra(){
			$ret=[];
			if(isset($this->letraDesde) && $this->letraDesde) $ret[]=$this->letraDesde;
			if(isset($this->letraHasta) && $this->letraHasta) $ret[]=$this->letraHasta;
			if($ret) return implode("-",$ret);
			else return "";
		}

		

	}