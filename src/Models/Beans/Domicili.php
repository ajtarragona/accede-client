<?php

	namespace Ajtarragona\Accede\Models\Beans; 
	use Ajtarragona\Accede\Models\AccedeObject;

	class Domicili extends AccedeObject{
		protected static $SML_SINGLE = "domicilio";
		protected static $SML_LIST = "l_domicilio";

		
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
	    public $codigoTipoVia;
	    public $codigoIneTipoVia;
	    public $nombreTipoVia;
	    public $codigoVia;
	    public $codigoIneVia;
	    public $nombreVia;
	    public $numeroDesde;
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

		

		

	}