{{-- @dump($domicili)
@dump($plantes)
 --}}


	@input([
		'label'=>'Carrer', 
		'name'=>'codigoIneVia',
		'class'=> 'field_carrer autocomplete form-control',
		'value' => isset($domicili->nombreVia)?$domicili->nombreVia:'',
		'data' => [
			'multiple'=> false,
			'url' => route('accede.vies.combo',[$currentProvincia->codigoProvincia,$currentMunicipi->codigoMunicipio
			]),
			'value' => $domicili->codigoIneVia,
			'savevalue' => true,
			'showvalue' => false,
		],
		'icon' => 'map-marker-alt',
		"disabled" =>$readonly,
	])

	@row(['class'=>'gap-xs'])	
		
			@col(['size'=>isset($small)?6:3])
				@input([
					"name"=>"numeroDesde",
					"required"=>false,
					'type'=>'text',
					'class' => 'field_numero number form-control',
					"label"=>"Numero (des de)",
					"value"=> $domicili->numeroDesde,
					"disabled" =>$readonly,
				])
			@endcol
			@col(['size'=>isset($small)?6:3])
				@input([
					"name"=>"numeroHasta",
					"required"=>false,
					'type'=>'text',
					'class' => 'field_numero2 number form-control',
					"label"=>"Numero (fins a)",
					"value"=> $domicili->numeroHasta,
					"disabled" =>$readonly,
				])
			@endcol
			@col(['size'=>isset($small)?6:3])
				@input([
					"name"=>"letraDesde",
					"required"=>false,
					'class' => 'field_lletra form-control',
					"label"=>"Lletra (des de)",
					"value"=> $domicili->letraDesde,
					"disabled" =>$readonly,
				])
			@endcol

			@col(['size'=>isset($small)?6:3])
				@input([
					"name"=>"letraHasta",
					"required"=>false,
					'class' => 'field_lletra2 form-control',
					"label"=>"Lletra (fins a)",
					"value"=> $domicili->letraHasta,
					"disabled" =>$readonly,
				])
			@endcol
		@endrow


		@row(['class'=>'gap-xs'])	
			@col(['size'=>isset($small)?6:2])
				@select([
					"name"=>"codigoBloque",
					"required"=>false,
					'class' => 'field_bloc ',
					"label"=>"Bloc",
					"options"=>$blocs,
					'data'=>['width'=>'100%','live-search'=>true,'show-deselector'=>true],
					"selected"=> $domicili->codigoBloque,
					"disabled" =>$readonly,
					
				])
			@endcol
			
			@col(['size'=>isset($small)?6:2])
				@select([
					"name"=>"codigoEscalera",
					"required"=>false,
					'class' => 'field_escala',
					"label"=>"Escala",
					"options"=>$escales,
					'data'=>['width'=>'100%','live-search'=>true,'show-deselector'=>true],
					"selected"=> $domicili->codigoEscalera,
					"disabled" =>$readonly,
					
				])
			@endcol
			

			@col(['size'=>isset($small)?6:2])

				@select([
					"name"=>"codigoPlanta",
					"required"=>false,
					'class' => 'field_planta',
					"label"=>"Planta",
					"options"=>$plantes,
					'data'=>['width'=>'100%','live-search'=>true,'show-deselector'=>true],
					"selected"=> $domicili->codigoPlanta,
					"disabled" =>$readonly,
					
				])
			@endcol

			@col(['size'=>isset($small)?6:2])
				@select([
					"name"=>"codigoPuerta",
					"required"=>false,
					'class' => 'field_porta',
					"label"=>"Porta",
					"options"=>$portes,
					'data'=>['width'=>'100%','live-search'=>true,'show-deselector'=>true],
					"selected"=> $domicili->codigoPuerta,
					"disabled" =>$readonly,
					
				])
			@endcol
			
			@col(['size'=>isset($small)?6:2])
				@input([
					"name"=>"kilometro",
					"required"=>false,
					'class' => 'field_km form-control',
					"label"=>"Km.",
					"disabled" =>$readonly,
					"value"=> $domicili->kilometro,
				])
			@endcol


			@col(['size'=>isset($small)?6:2])
				@select([
					"name"=>"codigoPostal",
					"required"=>false,
					'class' => 'field_codipostal',
					"label"=>"Codi Postal",
					"options"=>$codispostals,
					"disabled" =>$readonly,
					'data'=>['width'=>'100%','live-search'=>true,'show-deselector'=>true],
					"selected"=> $domicili->codigoPostal,
					
				])
			@endcol
		@endrow

		